<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DhmdDetail extends Model
{
    use HasFactory;

    protected $table = 'dhmd_detail';

    protected $fillable = [
        'dhmd_idpresensi',
        'user_nik',
        'status'
    ];

    public function idPresensi()
    {
        return $this->belongsTo(Dhmd::class, 'idpresensi', 'idpresensi');
    }

    public function userNik()
    {
        return $this->belongsTo(User::class, 'user_nik', 'nik');
    }
}
