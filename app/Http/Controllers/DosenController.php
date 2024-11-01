<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class DosenController extends Controller
{
    public function index(){
        $matakuliah = Matakuliah::paginate(10);
        return view("dosen.matakuliah",compact('matakuliah'));
    }
}
