<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert program studi into the program_studi table with numeric IDs
        DB::table('program_studi')->insert([
            // Program studi untuk Fakultas Kedokteran (fakultas_id = 1)
            ['id' => 1, 'program_studi' => 'Kedokteran Umum', 'fakultas_id' => 1],
            ['id' => 2, 'program_studi' => 'Kedokteran Spesialis', 'fakultas_id' => 1],

            // Program studi untuk Fakultas Teknologi dan Rekayasa Cerdas (fakultas_id = 2)
            ['id' => 3, 'program_studi' => 'Teknik Informatika', 'fakultas_id' => 2],
            ['id' => 4, 'program_studi' => 'Sistem Informasi', 'fakultas_id' => 2],
            ['id' => 5, 'program_studi' => 'Teknik Elektro', 'fakultas_id' => 2],

            // Program studi untuk Fakultas Psikologi (fakultas_id = 3)
            ['id' => 6, 'program_studi' => 'Psikologi Umum', 'fakultas_id' => 3],

            // Program studi untuk Fakultas Humaniora dan Industri Kreatif (fakultas_id = 4)
            ['id' => 7, 'program_studi' => 'Desain Komunikasi Visual', 'fakultas_id' => 4],
            ['id' => 8, 'program_studi' => 'Sastra Inggris', 'fakultas_id' => 4],

            // Program studi untuk Fakultas Hukum dan Bisnis Digital (fakultas_id = 5)
            ['id' => 9, 'program_studi' => 'Ilmu Hukum', 'fakultas_id' => 5],
            ['id' => 10, 'program_studi' => 'Bisnis Digital', 'fakultas_id' => 5],

            // Program studi untuk Fakultas Kedokteran Gigi (fakultas_id = 6)
            ['id' => 11, 'program_studi' => 'Kedokteran Gigi', 'fakultas_id' => 6],
        ]);
    }
}
