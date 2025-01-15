<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::with('role', 'programStudi')->get();
    //     return view('users.index', compact('users'));
    // }

    // public function create()
    // {
    //     $roles = Role::all();
    //     $programStudi = ProgramStudi::all();
    //     return view('users.create', compact('roles', 'programStudi'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nik' => 'required|unique:users',
    //         'nama' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:3',
    //         'role_id' => 'required',
    //         'program_studi_id' => 'required',
    //     ]);

    //     User::create([
    //         'nik' => $request->nik,
    //         'nama' => $request->nama,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role_id' => $request->role_id,
    //         'program_studi_id' => $request->program_studi_id,
    //     ]);

    //     Log::info('Storing new mahasiswa', []);

    //     return redirect()->route('users.index')->with('success', 'User created successfully.');
    // }

    // public function show($id)
    // {
    //     $user = User::with('role', 'programStudi')->findOrFail($id);
    //     return view('users.show', compact('user'));
    // }

    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     $roles = Role::all();
    //     $programStudi = ProgramStudi::all();
    //     return view('users.edit', compact('user', 'roles', 'programStudi'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);

    //     $request->validate([
    //         'nik' => 'required|unique:users,nik,' . $user->id,
    //         'nama' => 'required',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'role_id' => 'required',
    //         'program_studi_id' => 'required',
    //     ]);

    //     $user->update([
    //         'nik' => $request->nik,
    //         'nama' => $request->nama,
    //         'email' => $request->email,
    //         'role_id' => $request->role_id,
    //         'program_studi_id' => $request->program_studi_id,
    //     ]);

    //     return redirect()->route('users.index')->with('success', 'User updated successfully.');
    // }

    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();
    //     return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    // }

    public function indexDosen(Request $request)
    {
        $dosens = User::where('role_id', 2);
        $dosens = $dosens->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    public function createDosen()
    {
        $programStudis = ProgramStudi::all();

        return view('admin.dosen.create', compact('programStudis')); 
    }

    public function storeDosen(Request $request)
    {
        Log::info('Storing new dosen', [
            'request_data' => $request->all()
        ]);
        
        $request->validate([
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'program_studi_id' => 'required',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('Dosen123'),
            'role_id' => '2',
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen created successfully.');
    }

    public function editDosen(User $dosen)
    {
        $programStudis = ProgramStudi::all();
        return view('admin.dosen.edit', compact('dosen', 'programStudis')); 
    }

    public function updateDosen(Request $request, $id)
    {
        Log::info('Updating dosen', [
            'request_data' => $request->all(),
            'dosen_id' => $id
        ]);

        $dosen = User::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:users,nik,' . $dosen->id,
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $dosen->id,
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $dosen->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen updated successfully.');
    }


    public function destroyDosen($id)
    {
        $dosen = User::findOrFail($id);
        $dosen->delete();
        Log::info('Dosen deleted, redirecting to index');
        return redirect()->route('admin.dosen.index')->with('danger', 'Dosen deleted successfully.');
    }

    public function indexMahasiswa(Request $request)
    {
        $students = User::with('programStudi.fakultas')
                    ->where('role_id', '3')
                    ->paginate(10);
        return view('admin.mahasiswa.index', compact(var_name: 'students'));
    }

    public function createMahasiswa()
    {
        $programStudis = ProgramStudi::all();

        return view('admin.mahasiswa.create', compact('programStudis')); 
    }

    public function storeMahasiswa(Request $request)
    {
        Log::info('Storing new mahasiswa', [
            'request_data' => $request->all()
        ]);
        
        $request->validate([
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'program_studi_id' => 'required',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->nik),
            'role_id' => '3',
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }

    public function editMahasiswa(User $mahasiswa)
    {
        $programStudis = ProgramStudi::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'programStudis')); 
    }

    public function updateMahasiswa(Request $request, $id)
    {
        Log::info('Updating dosen', [
            'request_data' => $request->all(),
            'dosen_id' => $id
        ]);

        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:users,nik,' . $mahasiswa->id,
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->id,
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $mahasiswa->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa updated successfully.');
    }

    public function destroyMahasiswa($id)
    {
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->delete();
        Log::info('Mahasiswa deleted, redirecting to index');
        return redirect()->route('admin.mahasiswa.index')->with('danger', 'Mahasiswa deleted successfully.');
    }

}
