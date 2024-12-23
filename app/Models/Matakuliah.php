<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
<<<<<<< Updated upstream
        'kelas',
        'sks'
    ];

}
=======
        'sks',
        'program_studi_id' 

    ];

    public function kehadiran()
    {
        return $this->hasMany(Dhmd::class, 'id_matakuliah', 'id_matakuliah');
    }

    public function details()
    {
        return $this->hasMany(MatakuliahDetail::class, 'matkul_id', 'id');
    }
}
>>>>>>> Stashed changes
