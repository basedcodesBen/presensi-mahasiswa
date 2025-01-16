<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dhmd extends Model
{
    use HasFactory;

    protected $table = 'dhmd';

    protected $primaryKey = "idpresensi";

    protected $fillable = [
        'idpresensi',
        'tanggal',
        'id_matakuliah',
        'pertemuan',
        'qr_code',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah', 'id');
    }
    public function details()
    {
        return $this->hasMany(DhmdDetail::class, 'dhmd_idpresensi', 'idpresensi');
    }
}
