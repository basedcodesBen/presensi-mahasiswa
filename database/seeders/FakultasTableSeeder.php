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
            ['nama_fakultas' => 'Fakultas Kedokteran'],
            ['nama_fakultas' => 'Fakultas Teknologi dan Rekayasa Cerdas'],
            ['nama_fakultas' => 'Fakultas Psikologi'],
            ['nama_fakultas' => 'Fakultas Humaniora dan Industri Kreatif'],
            ['nama_fakultas' => 'Fakultas Hukum dan Bisnis Digital'],
            ['nama_fakultas' => 'Fakultas Kedokteran Gigi'],
        ]);
    }
}
