<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role'; // Specify the singular table name

    protected $fillable = ['nama_role']; // Use the correct column name

    public function users()
    {
        return $this->hasMany(User::class, 'role_id'); // Ensure this relationship is correct
    }
}
