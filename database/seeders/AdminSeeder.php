<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admins = 
            [
            [
            'username' => 'admin', // Ganti dengan username yang Anda inginkan
            'password' => Hash::make('northexpo123'), // Ganti dengan password yang Anda inginkan
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'username' => 'Aril', // Ganti dengan username yang Anda inginkan
            'password' => Hash::make('aril0311'), // Ganti dengan password yang Anda inginkan
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [   
            'username' => 'Royhan', // Ganti dengan username yang Anda inginkan
            'password' => Hash::make('Royhan227'), // Ganti dengan password yang Anda inginkan
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'username' => 'Mavis', // Ganti dengan username yang Anda inginkan
            'password' => Hash::make('Mavis228'), // Ganti dengan password yang Anda inginkan
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'username' => 'Putra', // Ganti dengan username yang Anda inginkan
            'password' => Hash::make('Putra123'), // Ganti dengan password yang Anda inginkan
            'created_at' => now(),
            'updated_at' => now(),
            ]
            ];

        DB::table('role_admins')->insert($role_admins);
    }
}
