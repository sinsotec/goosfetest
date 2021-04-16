<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'soporte',
            'email' => 'pdigitalgroup@hotmail.com',
            'password' => Hash::make('634949Tsc.'),
            'prioridad' => '100',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'luisfelipe1364@gmail.com',
            'password' => Hash::make('123456789'),
            'prioridad' => '100',
        ]);
    }
}
