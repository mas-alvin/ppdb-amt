<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PortalUserService;
use Illuminate\Http\Request;
use Exception;

class PortalUserController extends Controller
{
    protected $portalUserService;

    public function __construct(PortalUserService $portalUserService)
    {
        $this->portalUserService = $portalUserService;
    }

    public function index()
    {
        $users = $this->portalUserService->getAllStudents();
        return view('pages.admin.portal-users.index', compact('users'));
    }

    public function destroy(User $portalUser)
    {
        try {
            $this->portalUserService->deleteUser($portalUser);
            return back()->with('success', 'Akun pengguna berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function resetPassword(User $portalUser)
    {
        try {
            $this->portalUserService->resetPassword($portalUser, 'password123');
            return back()->with('success', 'Password akun siswa "' . $portalUser->name . '" berhasil direset menjadi "password123".');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
