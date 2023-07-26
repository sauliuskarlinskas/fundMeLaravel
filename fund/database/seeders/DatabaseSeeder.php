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
        DB::table('users')->insert([
            'name' => 'Ona',
            'email' => 'ona@gmail.com',
            'password' => Hash::make('123')
        ]);
        DB::table('users')->insert([
            'name' => 'Mike',
            'email' => 'mike@gmail.com',
            'password' => Hash::make('123')
        ]);

        foreach (range(1, 5) as $_) {
            DB::table('ideas')->insert([
                'user_id' => $faker->numberBetween(1, 5),
                'description' => $faker->realText($maxNbChars = 100, $indexSize = 2),
                'main_image' => $faker->imageUrl($width = 640, $height = 480, 'cats'),
                'money_need' => $faker->numberBetween($min = 100, $max = 9000),
                'love' => 0
            ]);
        }
    }
}
