<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\MataKuliahDetail;

class DosenController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliahDetail::with('mataKuliah')
            ->where('user_nik', auth()->user()->nik)
            ->withCount(['mahasiswa as jumlah_mahasiswa']) // Alias the count
            ->get();

        return view("dosen.matakuliah", compact('matakuliah'));
    }
}
