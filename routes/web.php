<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('auth.login');
});

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')
        ->middleware(['throttle:5,1']) // Maksimal 5 percobaan login dalam 1 menit
        ->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah');
});

// User routes
Route::prefix('user')->middleware(['auth', 'role:member'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});
