<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'mata_kuliah';

    // Jika Anda menggunakan kolom 'nik', pastikan kolom ini bisa diisi
    protected $fillable = [
        'id_matakukiah',
        'nama_matakuliah',
        'kelas',
        'sks'
    ];

}
