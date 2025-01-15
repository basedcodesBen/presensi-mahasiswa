<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';

    protected $fillable = [
        'program_studi',
        'fakultas_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function matkul()
    {
        return $this->hasMany(Matakuliah::class, 'id');
    }
}
