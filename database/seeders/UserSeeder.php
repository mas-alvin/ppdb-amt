<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin account
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Student account
        User::create([
            'name' => 'Alfiansyah',
            'username' => 'alfiansyah',
            'email' => 'alfin@gmail.com',
            'password' => Hash::make('alfin123'),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
