<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Matakuliah;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matakuliah::insert([
            [
                'kode_matakuliah' => 'IN285',
                'nama_matakuliah' => 'Pemrograman Multipatform',
                'sks' => 3,
                'program_studi_id' => 3
            ],
            [
                'kode_matakuliah' => 'IN210',
                'nama_matakuliah' => 'Jaringan Komputer',
                'sks' => 3,
                'program_studi_id' => 3
            ],
            [
                'kode_matakuliah' => 'IN211',
                'nama_matakuliah' => 'Logika Informatika',
                'sks' => 3,
                'program_studi_id' => 3
            ],
            [
                'kode_matakuliah' => 'IN212',
                'nama_matakuliah' => 'Web Dasar',
                'sks' => 3,
                'program_studi_id' => 3
            ],
            [
                'kode_matakuliah' => 'MK001',
                'nama_matakuliah' => 'Bahasa Inggris',
                'sks' => 2,
                'program_studi_id' => 3
            ],
            [
                'kode_matakuliah' => 'KD001',
                'nama_matakuliah' => 'Anatomi',
                'sks' => 3,
                'program_studi_id' => 1
            ],
        ]);
    }
}
