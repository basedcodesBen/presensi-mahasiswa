<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $majors = ProgramStudi::all();
        return view('admin.prodi.index', compact('majors'));
    }

    public function create()
    {
        return view('admin.prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required|string|max:255',
        ]);

        ProgramStudi::create([
            'program_studi' => $request->program_studi,
        ]);

        return redirect()->route('admin.prodi.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }
}
