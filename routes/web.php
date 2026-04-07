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

Route::prefix('admin')->name('admin.')->group(function () {
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
