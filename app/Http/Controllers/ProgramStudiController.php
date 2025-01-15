<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProgramStudiController extends Controller
{
    public function index()
    {   
        return view('admin.programstudi.index', [
            'prodis' => ProgramStudi::all(),
            'fakultas' => Fakultas::all()
        ]);
    }

    public function create()
    {   
        return view('admin.programstudi.create', [
            'fakultas' => Fakultas::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required',
            'fakultas_id' => 'required'
        ]);

        ProgramStudi::create([
            'program_studi' => $request->program_studi,
            'fakultas_id' => $request->fakultas_id,
        ]);

        return redirect()->route('admin.programstudi.index')->with('success', 'Program Studi created successfully.');
    }

    public function edit($id)
    {
        $prodi = ProgramStudi::findOrFail($id);
        $fakultas = Fakultas::all();
        return view('admin.programstudi.edit', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, $id)
    {
        $prodi = ProgramStudi::findOrFail($id);

        $request->validate([
            'program_studi' => 'required',
            'fakultas_id' => 'required',
        ]);
        
        $prodi->update([
            'nama_fakultas' => $request->nama,
            'fakultas_id' => $request->fakultas_id,
        ]);

        return redirect()->route('admin.programstudi.index')->with('success', 'Program Studi updated successfully.');
    }

    public function destroy($id)
    {
        $prodi = ProgramStudi::findOrFail($id);
        $prodi->delete();
        return redirect()->route('admin.programstudi.index')->with('danger', 'Program Studi deleted successfully.');
    }
}
