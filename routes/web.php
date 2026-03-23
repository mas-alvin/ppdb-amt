<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::prefix('pendaftaran')->group(function () {
    Route::get('/', function () {
        return view('pages.registration.wizard');
    });
    Route::get('/dokumen', function () {
        return view('pages.registration.documents');
    });
    Route::get('/status', function () {
        return view('pages.registration.status');
    });
});
