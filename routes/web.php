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
        $user = auth()->user();
        $registration = \App\Models\Registration::where('user_id', $user->id)->first();
        $progress = $user->calculateProgress();
        $announcements = \App\Models\Announcement::where('is_active', true)->latest()->take(5)->get();

        return view('pages.students.dashboard', compact('registration', 'progress', 'announcements'));
    })->name('student.dashboard');

    Route::prefix('pendaftaran')->name('student.pendaftaran.')->group(function () {
        Route::get('/', [\App\Http\Controllers\RegistrationController::class, 'create'])->name('wizard');
        
        Route::post('/store', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('store');
    });

    Route::get('/dokumen', [\App\Http\Controllers\Student\DocumentController::class, 'index'])->name('student.documents.index');
    Route::post('/dokumen/store', [\App\Http\Controllers\Student\DocumentController::class, 'store'])->name('student.documents.store');

    Route::get('/status', function () {
        $user = auth()->user();
        $registration = \App\Models\Registration::where('user_id', $user->id)->first();
        $progress = $user->calculateProgress();
        $stages = \App\Models\Stage::where('is_active', true)->orderBy('order')->get();

        return view('pages.students.status', compact('registration', 'progress', 'stages'));
    })->name('student.status');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
    
    // Registrations
    Route::get('/registrations', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/{id}', [\App\Http\Controllers\RegistrationController::class, 'show'])->name('registrations.show');
    Route::patch('/registrations/{id}/status', [\App\Http\Controllers\RegistrationController::class, 'updateStatus'])->name('registrations.update-status');
    
    // Documents Verification
    Route::patch('/documents/{id}/status', [\App\Http\Controllers\RegistrationController::class, 'updateDocumentStatus'])->name('documents.update-status');
    
    // Jurusans
    Route::resource('jurusan', \App\Http\Controllers\Admin\JurusanController::class);

    Route::view('/documents', 'pages.admin.documents.index')->name('documents.index');
    // Wave / Schedule
    Route::resource('schedule', \App\Http\Controllers\Admin\WaveController::class);
    Route::view('/portal-users', 'pages.admin.portal-users.index')->name('portal-users.index');
    Route::resource('content', \App\Http\Controllers\Admin\AnnouncementController::class);
    Route::patch('/content/{announcement}/toggle', [\App\Http\Controllers\Admin\AnnouncementController::class, 'toggleStatus'])->name('content.toggle');
    Route::view('/reporting', 'pages.admin.reporting.index')->name('reporting.index');
    Route::view('/activity', 'pages.admin.activity.index')->name('activity.index');
    Route::view('/settings', 'pages.admin.settings.index')->name('settings.index');
});
