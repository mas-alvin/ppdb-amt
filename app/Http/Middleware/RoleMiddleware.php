<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            if ($request->user() && $request->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($request->user() && $request->user()->role === 'student') {
                return redirect()->route('student.dashboard');
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
}
