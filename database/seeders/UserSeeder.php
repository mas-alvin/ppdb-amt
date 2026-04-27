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
            'name' => 'Admin AMT',
            'username' => 'admin',
            'email' => 'admin@amt.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Student account
        User::create([
            'name' => 'Alfiansyah Student',
            'username' => 'alfiansyah',
            'email' => 'alfiansyah@amt.test',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
