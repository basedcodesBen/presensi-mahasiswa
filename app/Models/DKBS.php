<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DKBS extends Model
{
    use HasFactory;

    protected $table = 'dkbs';

    protected $fillable = [
        'user_nik',
        'id_matakuliah',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_nik', 'nik');
    }

    public function kelas()
    {
        return $this->belongsTo(MataKuliahDetail::class, 'id_matakuliah', 'id');
    }
}
