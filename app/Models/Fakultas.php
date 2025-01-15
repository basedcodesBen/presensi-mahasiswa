<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Fakultas extends Authenticatable
{
    protected $table = 'fakultas';

    protected $fillable = [
        'nama_fakultas',
    ];

    public function fakultas()
    {
        return $this->hasMany(ProgramStudi::class, 'fakultas_id');
    }

    public function matakuliah()
    {
        return $this->hasManyThrough(
            Matakuliah::class,
            ProgramStudi::class,
            'fakultas_id',
            'program_studi_id',
            'id',
            'id'
        );
    }
}
