<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FakultasTableSeeder::class,  // Seeder Role
            ProgramStudiTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,// Seeder User
            MatkulSeeder::class
        ]);
    }
}
