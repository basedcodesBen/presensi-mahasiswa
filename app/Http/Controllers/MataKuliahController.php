<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Fakultas;
use App\Models\Matakuliah;
use App\Models\MataKuliahDetail;
use App\Models\DKBS;
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

    public function addMahasiswa($fakultas, $prodi, $matkul, $kelas)
    {
        $programStudi = ProgramStudi::findOrFail($prodi);
        $faculty = Fakultas::findOrFail($fakultas);
        $mk = Matakuliah::findOrFail($matkul);
        $class = MataKuliahDetail::findOrFail($kelas);
        $dosen = User::where('nik', $class->user_nik)->firstOrFail();
        $mk = Matakuliah::findOrFail($matkul);
        $mahasiswa = User::where('program_studi_id', $prodi)
            ->where('role_id', 3)
            ->get();

        $mahasiswa = $mahasiswa->filter(function ($mahasiswa) use ($class) {
            return !DKBS::where('user_nik', $mahasiswa->nik)
                ->where('id_matakuliah', $class->id)
                ->exists();
        });

        $murid = DKBS::where('id_matakuliah', $kelas)->get();
        Log::info($murid);

        return view('admin.matakuliah.addmahasiswa', compact('programStudi', 'faculty', 'dosen' , 'mk', 'class', 'mahasiswa', 'murid'));
    }

    public function editMatkul($fakultas, $prodi, $mk)
    {
        $programStudi = ProgramStudi::findOrFail($prodi);
        $faculty = Fakultas::findOrFail($fakultas);
        $matkul = Matakuliah::findOrFail($mk);

        return view('admin.matakuliah.edit', compact('programStudi', 'faculty', 'matkul'));
    }

    public function editClass($fakultas, $prodi, $mk, $class)
    {
        $programStudi = ProgramStudi::findOrFail($prodi);
        $faculty = Fakultas::findOrFail($fakultas);
        $matkul = Matakuliah::findOrFail($mk);
        $kelas = MataKuliahDetail::findOrFail($class);
        $dosen = User::where('program_studi_id', $prodi)->where('role_id', 2)->get();

        return view('admin.matakuliah.editkelas', compact('programStudi', 'faculty', 'matkul', 'kelas', 'dosen'));
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

    public function storeMahasiswa(Request $request, $fakultas, $prodi, $matkul, $kelas)
    {
        $request->validate([
            'mahasiswa' => 'required|array',
            'mahasiswa.*' => 'exists:users,nik'
        ]);

        Log::info('Mahasiswa NIKs:', $request->mahasiswa);

        foreach ($request->mahasiswa as $mahasiswaNik) {
            DKBS::create([
                'user_nik' => $mahasiswaNik,
                'id_matakuliah' => $kelas,
            ]);
        }

        return redirect()->route('admin.matakuliah.addmahasiswa', ['fakultas' => $fakultas, 'prodi' => $prodi, 'matkul' => $matkul, 'kelas' => $kelas])
            ->with('success', 'Mahasiswa berhasil ditambah.');
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

    public function updateKelas(Request $request, $fakultas, $prodi, $mk, $class)
    {
        Log::info('masuk update');
        
        $kelas = MataKuliahDetail::findOrFail($class);
        Log::info($kelas);
        
        $request->validate([
            'dosen' => 'required',
            'kelas' => 'required',
        ]);
        Log::info($request);

        $kelas->update([
            'user_nik' => $request->dosen,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.matakuliah.matkuldetail', ['fakultas' => $fakultas, 'prodi' => $prodi, 'matkul' => $mk])->with('success', 'Mata Kuliah updated successfully.');
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
        $dosenDetails = MataKuliahDetail::with('dosen')->where('matkul_id', $matkul)->get();
        Log::info($dosenDetails->toArray());

        $matkul = Matakuliah::findOrFail($matkul);

        return view('admin.matakuliah.matkuldetail', compact('fakultas', 'programStudi', 'dosenDetails', 'matkul'));
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
    
    public function destroyDosen($fakultas, $prodi, $matkul, $dosen)
    {
        try {
            $mk = MataKuliahDetail::findOrFail($dosen);
            $mk->delete();
            return redirect()->route('admin.matakuliah.matkuldetail', ['fakultas' => $fakultas, 'prodi' => $prodi, 'matkul' => $matkul])->with('danger', 'Dosen deleted successfully.');
        
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Dosen gagal dihapus.');
            }

            throw $e;
        }
    }

    public function destroyMahasiswa($fakultas, $prodi, $matkul, $kelas, $mahasiswa)
    {
        try {
            DKBS::where('user_nik', $mahasiswa)
            ->where('id_matakuliah', $matkul)
            ->delete();
    
            return redirect()->route('admin.matakuliah.addmahasiswa', ['fakultas' => $fakultas, 'prodi' => $prodi, 'matkul' => $matkul, 'kelas' => $kelas])
                ->with('success', 'Mahasiswa berhasil dihapus.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Mahasiswa gagal dihapus.');
            }

            throw $e;
        }
    }
}
