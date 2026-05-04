<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class PortalUserService
{
    public function getAllStudents()
    {
        return User::where('role', 'student')->latest()->get();
    }

    public function deleteUser(User $user)
    {
        try {
            return $user->delete();
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            throw new Exception('Gagal menghapus akun pengguna.');
        }
    }
}
