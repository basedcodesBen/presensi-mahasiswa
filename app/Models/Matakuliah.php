<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_matakuliah',
        'nama_matakuliah',
        'sks',
        'program_studi_id'
    ];

}
