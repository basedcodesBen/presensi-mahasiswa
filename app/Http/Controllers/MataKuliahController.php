<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Fakultas;
use App\Models\Matakuliah;
use App\Models\MataKuliahDetail;
use App\Models\ProgramStudi;
use Illuminate\Database\QueryException;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MataKuliahController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::withCount('matakuliah')->get();

        return view('admin.matakuliah.index', compact('fakultas'));
    }

    public function createMatkul($fakultas, $prodi)
    {
        $programStudi = ProgramStudi::findOrFail($prodi);
        $faculty = Fakultas::findOrFail($fakultas);

        return view('admin.matakuliah.create', compact('programStudi', 'faculty'));
    }
    
    public function createDosen($fakultas, $prodi, $matkul)
    {
        $programStudi = ProgramStudi::findOrFail($prodi);
        $faculty = Fakultas::findOrFail($fakultas);

        $dosen = User::where('program_studi_id', $prodi)
                ->where('role_id', 2)
                ->get();

        Log::info($dosen);
        
        $mk = Matakuliah::findOrFail($matkul);
        Log::info($mk);

        return view('admin.matakuliah.createdosen', compact('programStudi', 'faculty', 'dosen' , 'mk'));
    }

    public function editMatkul($fakultas, $prodi, $mk)
    {
        $programStudi = ProgramStudi::findOrFail($prodi);
        $faculty = Fakultas::findOrFail($fakultas);
        $matkul = Matakuliah::findOrFail($mk);

        return view('admin.matakuliah.edit', compact('programStudi', 'faculty', 'matkul'));
    }

    public function storeMatkul(Request $request, $fakultas, $prodi)
    {
        $request->validate([
            'kode' => 'required|unique:mata_kuliah,kode_matakuliah',
            'nama' => 'required',
            'sks' => 'required|int',
            'prodi' => 'required',
        ]);

        Matakuliah::create([
            'kode_matakuliah' => $request->kode,
            'nama_matakuliah' => $request->nama,
            'sks' => $request->sks,
            'program_studi_id' => $request->prodi,
        ]);

        return redirect()->route('admin.matakuliah.prodidetail', ['fakultas' => $fakultas, 'prodi' => $prodi])->with('success', 'Mata Kuliah created successfully.');
    }

    public function storeDosen(Request $request, $fakultas, $prodi, $mk)
    {
        $request->validate([
            'dosen' => 'required',
            'kelas' => 'required'
        ]);

        $exists = MataKuliahDetail::where('matkul_id', $mk)
            ->where('kelas', $request->kelas)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['kelas' => 'Kelas ini sudah terdaftar untuk mata kuliah ini.']);
        }

        MataKuliahDetail::create([
            'matkul_id' => $mk,
            'user_nik' => $request->dosen,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.matakuliah.matkuldetail', ['fakultas' => $fakultas, 'prodi' => $prodi, 'matkul' => $mk])
            ->with('success', 'Dosen berhasil ditambah.');
    }


    public function updateMatkul(Request $request, $fakultas, $prodi, $mk)
    {
        Log::info('masuk update');
        
        $matkul = Matakuliah::findOrFail($mk);
        Log::info($matkul);
        
        $request->validate([
            'kode' => 'required|unique:mata_kuliah,kode_matakuliah,' . $matkul->id,
            'nama' => 'required',
            'sks' => 'required'
        ]);
        Log::info($request);

        $matkul->update([
            'kode_matakuliah' => $request->kode,
            'nama_matakuliah' => $request->nama,
            'sks' => $request->sks,
        ]);

        return redirect()->route('admin.matakuliah.prodidetail', ['fakultas' => $fakultas, 'prodi' => $prodi])->with('success', 'Mata Kuliah updated successfully.');
    }

    public function fakultasDetail($id)
    {
        $fakultas = Fakultas::findOrFail($id);
    
        $programStudi = ProgramStudi::where('fakultas_id', $id)->get();
    
        $matakuliah = $programStudi->mapWithKeys(function ($program) {
            $count = MataKuliah::where('program_studi_id', $program->id)->count();
            return [$program->id => $count];
        });

        return view('admin.matakuliah.fakultasdetail', compact('fakultas', 'programStudi', 'matakuliah'));
    }

    public function prodiDetail($fakultas, $prodi) 
    {
        $fakultas = Fakultas::findOrFail($fakultas);

        $programStudi = ProgramStudi::findOrFail($prodi);

        $matakuliah = MataKuliah::where('program_studi_id', $prodi)->get();

        return view('admin.matakuliah.prodidetail', compact('fakultas', 'programStudi', 'matakuliah'));
    }

    public function matkulDetail($fakultas, $prodi, $matkul) 
    {
        $fakultas = Fakultas::findOrFail($fakultas);

        $programStudi = ProgramStudi::findOrFail($prodi);

        $dosen = User::whereHas('dosen', function ($query) use ($matkul) {
            $query->where('matkul_id', $matkul);
        })->with('dosen')->get();        

        $matkul = Matakuliah::findOrFail($matkul);


        return view('admin.matakuliah.matkuldetail', compact('fakultas', 'programStudi', 'dosen', 'matkul'));
    }

    public function destroyMatkul($fakultas, $prodi, $matkul)
    {
        try {
            $mk = Matakuliah::findOrFail($matkul);
            $mk->delete();
            return redirect()->route('admin.matakuliah.prodidetail', ['fakultas' => $fakultas, 'prodi' => $prodi])->with('danger', 'Mata Kuliah deleted successfully.');
        
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Mata Kuliah masih memiliki Dosen Aktif.');
            }

            throw $e;
        }
    }
}
