<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'user_type' => 1,
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'dob' => '1980-01-01',
            'race' => 'N/A',
            'religion' => 'N/A',
            'address' => 'Admin Address',
            'phone' => '1234567890',
        ]);

        // HR
        User::create([
            'user_type' => 2,
            'first_name' => 'HR',
            'last_name' => 'User',
            'email' => 'hr@example.com',
            'password' => Hash::make('password'),
            'gender' => 'female',
            'dob' => '1985-05-05',
            'race' => 'N/A',
            'religion' => 'N/A',
            'address' => 'HR Address',
            'phone' => '0987654321',
        ]);

        // Employee
        User::create([
            'user_type' => 3,
            'first_name' => 'Employee',
            'last_name' => 'User',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'),
            'gender' => 'male',
            'dob' => '1990-10-10',
            'race' => 'N/A',
            'religion' => 'N/A',
            'address' => 'Employee Address',
            'phone' => '1122334455',
        ]);
    }
}
