<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                'full_name' => 'Maxim Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'admin',
                'status' => 'active'
            ],
            // Vendor
            [
                'full_name' => 'Maxim Seller',
                'username' => 'Seller',
                'email' => 'seller@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'seller',
                'status' => 'active'
            ],
            // Customer    
            [
                'full_name' => 'Maxim Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'customer',
                'status' => 'active'
            ]
        ]);
    }
}
