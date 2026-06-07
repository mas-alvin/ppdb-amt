<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
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
            // Delete associated physical document files from storage
            foreach ($user->documents as $doc) {
                if (Storage::disk('public')->exists($doc->file_path)) {
                    Storage::disk('public')->delete($doc->file_path);
                }
            }
            return $user->delete();
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            throw new Exception('Gagal menghapus akun pengguna.');
        }
    }

    public function resetPassword(User $user, string $password)
    {
        try {
            $user->password = Hash::make($password);
            return $user->save();
        } catch (Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            throw new Exception('Gagal mereset password pengguna.');
        }
    }
}
