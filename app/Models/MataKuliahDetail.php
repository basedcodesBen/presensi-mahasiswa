<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahDetail extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_detail';

    protected $fillable = [
        'matkul_id',
        'user_nik',
        'kelas',
    ];

    public function mataKuliah(){
        return $this->belongsTo(Matakuliah::class, 'id', 'matkul_id');
    }

    public function dosen(){
        return $this->belongsTo(User::class, 'nik', 'users_nik');
    }
}
