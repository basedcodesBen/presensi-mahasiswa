<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_matakuliah',
        'nama_matakuliah',
        'kelas',
        'sks',
    ];

    public function kehadiran()
    {
        return $this->hasMany(Dhmd::class, 'id_matakuliah', 'id_matakuliah');
    }
}