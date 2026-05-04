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

    public function destroy(User $user)
    {
        try {
            $this->portalUserService->deleteUser($user);
            return back()->with('success', 'Akun pengguna berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
