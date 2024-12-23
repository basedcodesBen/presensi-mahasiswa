<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatakuliahDetail extends Model
{
   use HasFactory;

    protected $table = 'mata_kuliah_detail';

    protected $fillable = [
        'matkul_id',
        'user_nik',
        'kelas'
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matkul_id', 'id');
    }
}
