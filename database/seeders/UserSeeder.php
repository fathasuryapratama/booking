<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'Fatha',
            'email' => 'fatha@gmail.com',
            'password' => Hash::make('fatha'),
            'role' => 'user',
        ]);

        // Create more test users
        User::factory(5)->create([
            'role' => 'user',
            'password' => Hash::make('password')
        ]);
    }
}