<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert roles into the role table with specific IDs
        DB::table('role')->insert([
            ['id' => 1, 'nama_role' => 'Admin'],
            ['id' => 2, 'nama_role' => 'Dosen'],
            ['id' => 3, 'nama_role' => 'Mahasiswa'],
        ]);
    }
}
