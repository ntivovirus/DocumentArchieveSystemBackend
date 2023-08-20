<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Added manually
use Illuminate\Support\Facades\Hash; // Added manually


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' =>'Ray Kampe',
            'email' => 'ray@gmail.com',
            'password'=> Hash::make('1234'),
            'role'=>'Administrator'
        ]);
    }
}
