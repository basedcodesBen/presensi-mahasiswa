<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert users into the user table
        DB::table('users')->insert([
            [
                'nik' => '1234567',
                'nama' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 1, // Role Admin
                'program_studi_id' => '1', // Contoh program studi
            ],
            [
                'nik' => '2345678',
                'nama' => 'Dosen User',
                'email' => 'dosen@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 2, // Role Dosen
                'program_studi_id' => '2', // Contoh program studi
            ],
            [
                'nik' => '3456789',
                'nama' => 'Mahasiswa User',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('password'), // Password harus di-hash
                'role_id' => 3, // Role Mahasiswa
                'program_studi_id' => '3', // Contoh program studi
            ],
        ]);
    }
}
