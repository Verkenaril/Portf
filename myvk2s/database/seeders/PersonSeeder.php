<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('countries')->insert([
            "country" => "Россия"
        ]);
        
        DB::table('users')->insert([
            'name' => "soso",
            'email' => 'soso@mail.ru',
            'password' => Hash::make(123456789),
        ]);
        DB::table('peoples')->insert([
            'first_name' => "sosos",
            'second_name' => "sososon",
        ]);

        DB::table('users')->insert([
            'name' => "lolo",
            'email' => 'lolo@mail.ru',
            'password' => Hash::make(123456789),
        ]);
        DB::table('peoples')->insert([
            'first_name' => "loloa",
            'second_name' => "lolosd",
        ]);

        DB::table('countries')->insert([
            "country" => "Россия"
        ]);

        for($i = 0; $i < 10; $i++)
        {
            DB::table('users')->insert([
                'name' => fake()->name(),
                'email' => fake()->name().'@example.com',
                'password' => Hash::make('password'),
            ]);
            
            DB::table('peoples')->insert([
                'first_name' => fake()->name(),
                'second_name' => fake()->name(),
                "description" => fake()->paragraph(),
                "hobbies" => fake()->paragraph(),
            ]);
        }
    }
}
