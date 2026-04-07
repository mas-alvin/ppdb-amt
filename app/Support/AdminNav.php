<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

final class AdminNav
{
    public static function routeIsActive(string $routeName): bool
    {
        if (! Route::has($routeName)) {
            return false;
        }

        if ($routeName === 'admin.dashboard') {
            return request()->routeIs('admin.dashboard');
        }

        $base = Str::beforeLast($routeName, '.');

        return request()->routeIs($base.'.*') || request()->routeIs($routeName);
    }

    public static function routeUrl(string $routeName): string
    {
        return Route::has($routeName) ? route($routeName) : '#';
    }
}
