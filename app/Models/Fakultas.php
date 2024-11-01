<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Fakultas extends Authenticatable
{
    protected $table = 'fakultas';

    protected $fillable = [
        'id',
        'nama_fakultas',
    ];

    public function fakultas()
    {
        return $this->hasMany(ProgramStudi::class, 'fakultas_id');
    }
}
