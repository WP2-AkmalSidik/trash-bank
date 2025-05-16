<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\User\TransaksiController;
use App\Http\Controllers\Authentication\AuthController as AuthenticationController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')
        ->middleware(['throttle:5,1']) // Maksimal 5 percobaan login dalam 1 menit
        ->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Nasabah
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah');
    Route::post('/nasabah', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::post('/nasabah/generate-account', [NasabahController::class, 'generateAccountNumber'])->name('nasabah.generate-account');
    Route::get('/nasabah/{id}/edit', [NasabahController::class, 'edit'])->name('nasabah.edit');
    Route::put('/nasabah/{id}', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::delete('/nasabah/{id}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
});

// User routes
Route::prefix('user')->middleware(['auth', 'role:member'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('user.pengajuan');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('user.transaksi');
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
});
