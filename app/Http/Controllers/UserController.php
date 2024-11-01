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
    public function index()
    {
        $users = User::with('role', 'programStudi')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $programStudi = ProgramStudi::all();
        return view('users.create', compact('roles', 'programStudi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'program_studi_id' => 'required',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::with('role', 'programStudi')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $programStudi = ProgramStudi::all();
        return view('users.edit', compact('user', 'roles', 'programStudi'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:users,nik,' . $user->id,
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'program_studi_id' => 'required',
        ]);

        $user->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'program_studi_id' => $request->program_studi_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function indexDosen(Request $request)
    {
        $keyword = $request->input('q');
        $dosens = User::where('role_id', 2); // Asumsikan role_id '2' adalah untuk dosen

        if ($keyword) {
            $dosens->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%")
                    ->orWhere('nik', 'like', "%$keyword%"); // Gunakan 'nik' sebagai pengganti 'nidn'
            });
        }

        $dosens = $dosens->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    public function createDosen()
    {
        return view('admin.dosen.create'); 
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
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('Dosen123'),
            'role_id' => '2',
            'program_studi_id' => '3',
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen created successfully.');
    }

    public function editDosen(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen')); 
    }

    public function updateDosen(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required',
            // ... validasi lainnya ...
        ]);

        $dosen->update($request->all());

        return redirect()->route('dosen.index')->with('success', 'Dosen updated successfully.');
    }

    public function destroyDosen($id)
    {
        $dosen = User::findOrFail($id);
        $dosen->delete();
        Log::info('Dosen deleted, redirecting to index');
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen deleted successfully.');
    }
}
