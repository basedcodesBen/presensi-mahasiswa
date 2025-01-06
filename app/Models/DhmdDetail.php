<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DhmdDetail extends Model
{
    use HasFactory;

    protected $table = 'dhmd_detail'; // Table name in the database

    protected $fillable = [
        'dhmd_idpresensi', // Foreign key referencing dhmd.idpresensi
        'user_nik',        // Foreign key referencing users.nik
        'status',          // Attendance status (e.g., Hadir, Izin, Alpha)
        'created_at',      // Timestamp for creation
        'updated_at',      // Timestamp for last update
    ];

    /**
     * Relationship to the Dhmd model
     */
    public function dhmd()
    {
        return $this->belongsTo(Dhmd::class, 'dhmd_idpresensi', 'idpresensi');
    }

    /**
     * Relationship to the User model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_nik', 'nik');
    }
}
