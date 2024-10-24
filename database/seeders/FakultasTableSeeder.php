<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert fakultas into the fakultas table with numeric IDs
        DB::table('fakultas')->insert([
            ['id' => 1, 'nama_fakultas' => 'Fakultas Kedokteran'],
            ['id' => 2, 'nama_fakultas' => 'Fakultas Teknologi dan Rekayasa Cerdas'],
            ['id' => 3, 'nama_fakultas' => 'Fakultas Psikologi'],
            ['id' => 4, 'nama_fakultas' => 'Fakultas Humaniora dan Industri Kreatif'],
            ['id' => 5, 'nama_fakultas' => 'Fakultas Hukum dan Bisnis Digital'],
            ['id' => 6, 'nama_fakultas' => 'Fakultas Kedokteran Gigi'],
        ]);
    }
}
