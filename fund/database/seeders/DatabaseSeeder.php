<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Saulius',
            'email' => 'saulius@gmail.com',
            'password' => Hash::make('123')
        ]);

        DB::table('users')->insert([
            'name' => 'Ieva',
            'email' => 'ieva@gmail.com',
            'password' => Hash::make('123')
        ]);
        DB::table('users')->insert([
            'name' => 'Lara',
            'email' => 'lara@gmail.com',
            'password' => Hash::make('123')
        ]);
        DB::table('users')->insert([
            'name' => 'Bond',
            'email' => 'bond@gmail.com',
            'password' => Hash::make('123')
        ]);
    }
}
