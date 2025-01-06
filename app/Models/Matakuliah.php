<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
        'program_studi_id'
    ];

    public function kehadiran(){
        return $this->hasMany(Dhmd::class, 'id_matakuliah', 'id');
    }


    public function prodi(){
        return $this->belongsTo(ProgramStudi::class, 'id', 'program_studi_id');
    }

    public function mataKuliah(){
        return $this->hasMany(MataKuliahDetail::class, 'matkul_id', 'id');
    }
}