<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\ResidueController;
use App\Http\Controllers\Admin\TabunganController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\User\TransaksiController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\LaporanSampahController;
use App\Http\Controllers\Admin\LokasiBankSampahController;
use App\Http\Controllers\Admin\PengajuanController as PengajuanAdmin;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Authentication\AuthController as AuthenticationController;

// Authentication routes
Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->middleware('throttle:5,1')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Pengumuman resource routes (index, show, store, update, destroy)
    Route::resource('pengumuman', PengumumanController::class)
        ->names([
            'index' => 'pengumuman.index',
            'show' => 'pengumuman.show',
            'store' => 'pengumuman.store',
            'update' => 'pengumuman.update',
            'destroy' => 'pengumuman.destroy',
        ])->except(['create', 'edit']);

    // Lokasi Bank Sampah resource routes
    Route::resource('lokasi', LokasiBankSampahController::class)
        ->names([
            'index' => 'lokasi.index',
            'show' => 'lokasi.show',
            'store' => 'lokasi.store',
            'update' => 'lokasi.update',
            'destroy' => 'lokasi.destroy',
        ])->except(['create', 'edit']);

    // Residu routes (custom resource + extra print route)
    Route::prefix('residu')->group(function () {
        Route::get('/', [ResidueController::class, 'index'])->name('residu.index');
        Route::post('/', [ResidueController::class, 'store'])->name('residu.store');
        Route::get('/print', [ResidueController::class, 'printReport'])->name('residu.print');
        Route::get('/{residu}', [ResidueController::class, 'show'])->name('residu.show');
        Route::put('/{residu}', [ResidueController::class, 'update'])->name('residu.update');
        Route::delete('/{residu}', [ResidueController::class, 'destroy'])->name('residu.destroy');
    });

    // Transaksi routes (non-resource style with grouped prefix)
    Route::prefix('transaksi')->controller(TabunganController::class)->group(function () {
        Route::get('/', 'index')->name('transaksi.index');
        Route::post('/store', 'store')->name('transaksi.store');
        Route::delete('/histori/{id}', 'destroy')->name('transaksi.destroy');
        Route::get('/get-member-data', 'getMemberData')->name('transaksi.get-member-data');
        Route::get('/get-waste-price', 'getWastePrice')->name('transaksi.get-waste-price');
        Route::get('/history/{memberId}', 'history')->name('transaksi.history');
        Route::get('/print-receipt/{id}', 'printReceipt')->name('transaksi.print-receipt');
        Route::get('/print-history/{memberId}', 'printHistory')->name('transaksi.print-history');
    });

    // Nasabah resource routes with extra route for generateAccountNumber
    Route::resource('nasabah', NasabahController::class)
        ->names([
            'index' => 'nasabah',
            'store' => 'nasabah.store',
            'edit' => 'nasabah.edit',
            'update' => 'nasabah.update',
            'destroy' => 'nasabah.destroy',
        ])->except(['create', 'show']);

    Route::post('/nasabah/generate-account', [NasabahController::class, 'generateAccountNumber'])->name('nasabah.generate-account');

    // Sampah resource routes
    Route::resource('sampah', SampahController::class)
        ->names([
            'index' => 'sampah.index',
            'store' => 'sampah.store',
            'show' => 'sampah.show',
            'update' => 'sampah.update',
            'destroy' => 'sampah.destroy',
        ])->except(['create', 'edit']);

    // Pengajuan admin routes (custom, no full resource)
    Route::prefix('pengajuan')->controller(PengajuanAdmin::class)->group(function () {
        Route::get('/', 'index')->name('pengajuan.index');
        Route::get('/filter', 'filter')->name('pengajuan.filter');
        Route::post('/{id}/approve', 'approve')->name('pengajuan.approve');
        Route::post('/{id}/reject', 'reject')->name('pengajuan.reject');
        Route::post('/{id}/upload-proof', 'uploadProof')->name('pengajuan.upload-proof');
        Route::get('/{id}/proof', 'showProof')->name('pengajuan.show-proof');
    });

    // Reports routes
    Route::get('/laporan', [LaporanSampahController::class, 'index'])->name('laporan.index');
    Route::get('/export-laporan', [LaporanSampahController::class, 'exportPdf'])->name('laporan.export');
});

// User routes
Route::prefix('user')->middleware(['auth', 'role:member'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('user.transaksi');
    Route::get('/transaksi/filter', [TransaksiController::class, 'filter'])->name('user.transaksi.filter');

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');

    Route::prefix('pengajuan')->controller(PengajuanController::class)->group(function () {
        Route::get('/', 'index')->name('user.pengajuan');
        Route::get('/create', 'create')->name('user.pengajuan.create');
        Route::post('/', 'store')->name('user.pengajuan.store');
        Route::get('/proof/{id}', 'showProof')->name('user.pengajuan.proof');
    });
});
