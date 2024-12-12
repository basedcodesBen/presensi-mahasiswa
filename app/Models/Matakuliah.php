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
<<<<<<< HEAD
        'sks',
        'program_studi_id'
=======
        'kelas',
        'sks',
>>>>>>> 4e78f57855d2a2f55a6656595f320234a477f33b
    ];

    public function kehadiran()
    {
        return $this->hasMany(Dhmd::class, 'id_matakuliah', 'id_matakuliah');
    }
}