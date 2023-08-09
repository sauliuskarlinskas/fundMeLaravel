<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Saulius',
            'email' => 'saulius@gmail.com',
            'password' => Hash::make('321'),
            'role' => '20'
        ]);

        DB::table('users')->insert([
            'name' => 'Ieva',
            'email' => 'ieva@gmail.com',
            'password' => Hash::make('321'),
            'role' => '20'
        ]);
        DB::table('users')->insert([
            'name' => 'Lara',
            'email' => 'lara@gmail.com',
            'password' => Hash::make('123'),
            'role' => '1'
        ]);
        DB::table('users')->insert([
            'name' => 'Bond',
            'email' => 'bond@gmail.com',
            'password' => Hash::make('123'),
            'role' => '1'
        ]);
        DB::table('users')->insert([
            'name' => 'Ona',
            'email' => 'ona@gmail.com',
            'password' => Hash::make('123'),
            'role' => '1'
        ]);
        DB::table('users')->insert([
            'name' => 'Mike',
            'email' => 'mike@gmail.com',
            'password' => Hash::make('123'),
            'role' => '1'
        ]);

    }
}
