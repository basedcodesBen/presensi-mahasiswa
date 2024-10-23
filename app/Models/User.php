<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nik', 'nama', 'email', 'password', 'role_id', 'program_studi_id'
    ];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }
}
