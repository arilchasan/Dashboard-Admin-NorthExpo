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
            'username' => 'Aril',               
            'password' => Hash::make('aril0311'),       
            'role' => 'superadmin',        
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [   
            'username' => 'Royhan', 
            'password' => Hash::make('Royhan227'), 
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'username' => 'Mavis', 
            'password' => Hash::make('Mavis228'), 
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'username' => 'Putra', 
            'password' => Hash::make('Putra123'), 
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
                'username' => 'AdminGardu',  
                'password' => Hash::make('Gardu123'),  
                'role' => 'penjaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'AdminTheHillsVaganza',  
                'password' => Hash::make('TheHillsVaganza123'),  
                'role' => 'penjaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'AdminKedungGender',  
                'password' => Hash::make('KedungGender123'),  
                'role' => 'penjaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'AdminWaterpark',  
                'password' => Hash::make('Waterpark123'),  
                'role' => 'penjaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            ];

        DB::table('role_admins')->insert($role_admins);
    }
}
