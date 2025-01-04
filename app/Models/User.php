<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'password',
        'role_id',
        'program_studi_id'
    ];

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    public function isDosen()
    {
        return $this->role_id == 2;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function dosen()
    {
        return $this->hasMany(MataKuliahDetail::class, 'user_nik', 'nik');
    }

    public function attendances()
    {
        return $this->hasMany(Dhmd::class, 'user_nik', 'nik');
    }
    
    public function dkbs()
    {
        return $this->hasMany(DKBS::class, 'user_nik', 'nik');
    }
}
