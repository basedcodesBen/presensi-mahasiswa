<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Tentukan bahwa tabel yang digunakan adalah 'user'
    protected $table = 'users';

    // Jika Anda menggunakan kolom 'nik', pastikan kolom ini bisa diisi
    protected $fillable = [
        'id',
        'nik',  // Kolom nik di tabel user
        'nama',
        'email',
        'password',
        'role_id',
        'program_studi_id'
    ];
}
