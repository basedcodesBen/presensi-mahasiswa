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
        // Matakuliah::insert([
        //     [
        //         'id_matakuliah' => 'IN001',
        //         'nama_matakuliah' => 'Pemrograman Multipatform',
        //         'kelas' => 'A',
        //         'sks' => 3,
        //     ],
        //     [
        //         'id_matakukiah' => 'IN002',
        //         'nama_matakuliah' => 'Pemrograman Terapan',
        //         'kelas' => 'B',
        //         'sks' => 3,
        //     ],
        //     [
        //         'id_matakukiah' => 'IN003',
        //         'nama_matakuliah' => 'Internet of Things',
        //         'kelas' => 'C',
        //         'sks' => 3,
        //     ],
        //     [
        //         'id_matakukiah' => 'IN004',
        //         'nama_matakuliah' => 'Pemrograman Bahasa Alami',
        //         'kelas' => 'D',
        //         'sks' => 2,
        //     ],
        // ]);

        $faker = Faker::create();

        $matakuliahs = [];
         $kelasOptions = ['A', 'B', 'C', 'D']; // Array of kelas options

        for ($i = 1; $i < 21; $i++) {
            $matakuliahs[] = [
                'id_matakuliah' => 'IN0'.str_pad($i + 1, 2, '0', STR_PAD_LEFT), // Assuming IDs start from 1
                'nama_matakuliah' => $faker->word . ' ' . $faker->word,
                'kelas' =>  $kelasOptions[array_rand($kelasOptions)], 
                'sks' => $faker->numberBetween(2, 4), // Assuming SKS is between 2 and 4
            ];
        }

        DB::table('mata_kuliah')->insert($matakuliahs);
    }
}
