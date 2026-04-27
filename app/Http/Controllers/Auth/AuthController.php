<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show the login view.
     */
    public function showLogin(): View
    {
        return view('pages.auth.login');
    }

    /**
     * Show the register view.
     */
    public function showRegister(): View
    {
        return view('pages.auth.register');
    }

    /**
     * Handle authentication.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');

            if ($this->authService->login($credentials, $remember)) {
                $request->session()->regenerate();
                
                $user = auth()->user();
                if ($user->role === 'admin') {
                    return redirect()->intended(route('admin.dashboard'))
                        ->with('success', 'Selamat datang kembali, Admin!');
                }

                return redirect()->intended(route('student.dashboard'))
                    ->with('success', 'Selamat datang di Portal PPDB!');
            }

            return back()->withErrors([
                'email' => 'Kredensial yang Anda berikan tidak cocok dengan data kami.',
            ])->onlyInput('email');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Handle registration.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $this->authService->register($request->validated());

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan login menggunakan akun Anda.');
                
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Handle logout.
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
