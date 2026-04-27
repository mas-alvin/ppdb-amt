<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.students.dashboard');
    })->name('student.dashboard');

    Route::prefix('pendaftaran')->name('student.pendaftaran.')->group(function () {
        Route::get('/', function () {
            return view('pages.students.wizard');
        })->name('wizard');
        Route::get('/dokumen', function () {
            return view('pages.students.documents');
        })->name('documents');
        Route::get('/status', function () {
            return view('pages.students.status');
        })->name('status');
    });
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
    Route::view('/registrations', 'pages.admin.registrations.index')->name('registrations.index');
    Route::view('/documents', 'pages.admin.documents.index')->name('documents.index');
    Route::view('/pipeline', 'pages.admin.pipeline.index')->name('pipeline.index');
    Route::view('/portal-users', 'pages.admin.portal-users.index')->name('portal-users.index');
    Route::view('/content', 'pages.admin.content.index')->name('content.index');
    Route::view('/schedule', 'pages.admin.schedule.index')->name('schedule.index');
    Route::view('/reporting', 'pages.admin.reporting.index')->name('reporting.index');
    Route::view('/activity', 'pages.admin.activity.index')->name('activity.index');
    Route::view('/settings', 'pages.admin.settings.index')->name('settings.index');
});
