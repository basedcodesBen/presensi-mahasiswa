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
        'tanggal',
        'id_matakuliah',
        'pertemuan',
        'qr_code',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah', 'id_matakuliah');
    }
}
