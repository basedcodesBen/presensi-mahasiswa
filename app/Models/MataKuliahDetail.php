<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahDetail extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_detail';
    public $mahasiswa_count;

    protected $fillable = [
        'matkul_id',
        'user_nik',
        'kelas',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matkul_id', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'user_nik', 'nik');
    }

    public function mahasiswa()
    {
        return $this->hasMany(DKBS::class, 'id_matakuliah', 'id');
    }
}
