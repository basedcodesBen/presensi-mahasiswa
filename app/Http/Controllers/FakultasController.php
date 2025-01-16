<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class FakultasController extends Controller
{
    public function index()
    {
        $faculties = Fakultas::with('fakultas')->get();
        return view('admin.fakultas.index', compact('faculties'));
    }

    public function create()
    {
        return view('admin.fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Fakultas::create([
            'nama_fakultas' => $request->nama,
        ]);

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas created successfully.');
    }

    public function show($id)
    {
        $user = User::with('role', 'programStudi')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('admin.fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $request->validate([
            'nama' => 'required',
        ]);

        $fakultas->update([
            'nama_fakultas' => $request->nama,
        ]);

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $faculty = Fakultas::findOrFail($id);
            $faculty->delete();

            return redirect()->route('admin.fakultas.index')->with('success', 'Data Fakultas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.fakultas.index')->with('danger', 'Data Fakultas gagal dihapus.');
        }
    }
}
