<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'first_name'   => 'Admin',
            'last_name'    => 'Sahabat',
            'email'        => 'admin@test.com',
            'phone_number' => '081234567890', 
            'password'     => Hash::make('password123'),
            'role'         => 'admin',
        ]);

        User::create([
            'first_name'   => 'Dr. Agung',
            'last_name'    => 'Pakar',
            'email'        => 'pakar@test.com',
            'phone_number' => '082198765432',
            'password'     => Hash::make('password123'),
            'role'         => 'pakar',
        ]);

        User::create([
            'first_name'   => 'Budi',
            'last_name'    => 'Masyarakat',
            'email'        => 'budi@test.com',
            'phone_number' => '085711223344',
            'password'     => Hash::make('password123'),
            'role'         => 'masyarakat',
        ]);
    }   
}
