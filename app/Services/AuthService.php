<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthService
{
    /**
     * Handle user registration.
     * 
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function register(array $data): User
    {
        try {
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'student',
                'status' => 'active',
            ]);
        } catch (Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            throw new Exception('Gagal melakukan registrasi pendaftar baru.');
        }
    }

    /**
     * Handle user login.
     * 
     * @param array $credentials
     * @param bool $remember
     * @return bool
     * @throws Exception
     */
    public function login(array $credentials, bool $remember = false): bool
    {
        try {
            // Check if user exists and is active
            $user = User::where('email', $credentials['email'])
                        ->orWhere('username', $credentials['email'])
                        ->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return false;
            }

            if ($user->status !== 'active') {
                throw new Exception('Akun Anda sedang dinonaktifkan. Silakan hubungi admin.');
            }

            return Auth::attempt([
                'email' => $user->email,
                'password' => $credentials['password']
            ], $remember);

        } catch (Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Handle user logout.
     * 
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
