<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $users = [
            [
                'nik' => '1',
                'nama' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('1'),
                'role_id' => 1, // Role Admin
                'program_studi_id' => 3,
            ],
        ];

        $fakultasProgramStudi = [
            1 => [1, 2],
            2 => [3, 4, 5],
            3 => [6],
            4 => [7, 8],
            5 => [9, 10],
            6 => [11]
        ];

        for ($i = 0; $i < 4; $i++) {
            $users[] = [
                'nik' => '10' . $faker->unique()->numerify('##'),
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('admin'), // Password harus di-hash
                'role_id' => 1, // Role Admin
                'program_studi_id' => 2,
            ];
        }

        foreach ($fakultasProgramStudi as $fakultasId => $programStudiIds) {
            foreach ($programStudiIds as $programStudiId) {
                for ($i = 0; $i < 2; $i++) {
                    $users[] = [
                        'nik' => $fakultasId . $programStudiId . '0' . $faker->unique()->numerify('##'),
                        'nama' => $faker->name,
                        'email' => $faker->unique()->safeEmail,
                        'password' => Hash::make('dosen'), // Password harus di-hash
                        'role_id' => 2, // Role Dosen
                        'program_studi_id' => $programStudiId, // Specific program studi
                    ];
                }

                // Create 10 Mahasiswa users
                for ($i = 0; $i < 5; $i++) {
                    $users[] = [
                        'nik' => $fakultasId . $programStudiId . '0' . $faker->unique()->numerify('##'),
                        'nama' => $faker->name,
                        'email' => $faker->unique()->safeEmail,
                        'password' => Hash::make('mahasiswa'), // Password harus di-hash
                        'role_id' => 3, // Role Mahasiswa
                        'program_studi_id' => $programStudiId, // Specific program studi
                    ];
                }
            }
        }

        DB::table('users')->insert($users);
    }
}