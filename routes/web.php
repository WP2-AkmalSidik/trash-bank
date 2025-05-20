<?php

use App\Http\Controllers\Admin\LaporanSampahController;
use App\Http\Controllers\Admin\LokasiBankSampahController;
use App\Http\Controllers\Admin\PengumumanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\NasabahController;
use App\Http\Controllers\Admin\TabunganController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\Admin\PengajuanController as PengajuanAdmin;
use App\Http\Controllers\User\TransaksiController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Authentication\AuthController as AuthenticationController;


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/login', 'login')
        ->middleware(['throttle:5,1'])
        ->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Pengumuman Routes
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    
    // Lokasi Bank Sampah Routes
    Route::get('/lokasi', [LokasiBankSampahController::class, 'index'])->name('lokasi.index');
    Route::get('/lokasi/{id}', [LokasiBankSampahController::class, 'show'])->name('lokasi.show');
    Route::post('/lokasi', [LokasiBankSampahController::class, 'store'])->name('lokasi.store');
    Route::put('/lokasi/{id}', [LokasiBankSampahController::class, 'update'])->name('lokasi.update');
    Route::delete('/lokasi/{id}', [LokasiBankSampahController::class, 'destroy'])->name('lokasi.destroy');
    // Waste Deposit Transaction Routes
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TabunganController::class, 'index'])->name('transaksi.index');
        Route::post('/store', [TabunganController::class, 'store'])->name('transaksi.store');
        Route::delete('/histori/{id}', [TabunganController::class, 'destroy'])->name('transaksi.destroy');
        Route::get('/get-member-data', [TabunganController::class, 'getMemberData'])->name('transaksi.get-member-data');
        Route::get('/get-waste-price', [TabunganController::class, 'getWastePrice'])->name('transaksi.get-waste-price');
        Route::get('/history/{memberId}', [TabunganController::class, 'history'])->name('transaksi.history');
        Route::get('/print-receipt/{id}', [TabunganController::class, 'printReceipt'])->name('transaksi.print-receipt');
        Route::get('/print-history/{memberId}', [TabunganController::class, 'printHistory'])->name('transaksi.print-history');
        
    });
    // Nasabah
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('nasabah');
    Route::post('/nasabah', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::post('/nasabah/generate-account', [NasabahController::class, 'generateAccountNumber'])->name('nasabah.generate-account');
    Route::get('/nasabah/{id}/edit', [NasabahController::class, 'edit'])->name('nasabah.edit');
    Route::put('/nasabah/{id}', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::delete('/nasabah/{id}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
    // Waste Management Routes
    Route::get('/sampah', [SampahController::class, 'index'])->name('sampah.index');
    Route::post('/sampah', [SampahController::class, 'store'])->name('sampah.store');
    Route::get('/sampah/{id}', [SampahController::class, 'show'])->name('sampah.show');
    Route::put('/sampah/{id}', [SampahController::class, 'update'])->name('sampah.update');
    Route::delete('/sampah/{id}', [SampahController::class, 'destroy'])->name('sampah.destroy');
    // Pengajuan
    Route::get('/pengajuan', [PengajuanAdmin::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/filter', [PengajuanAdmin::class, 'filter'])->name('pengajuan.filter');
    Route::post('/pengajuan/{id}/approve', [PengajuanAdmin::class, 'approve'])->name('pengajuan.approve');
    Route::post('/pengajuan/{id}/reject', [PengajuanAdmin::class, 'reject'])->name('pengajuan.reject');
    Route::post('/pengajuan/{id}/upload-proof', [PengajuanAdmin::class, 'uploadProof'])->name('pengajuan.upload-proof');
    Route::get('/pengajuan/{id}/proof', [PengajuanAdmin::class, 'showProof'])->name('pengajuan.show-proof');
    // Reports
    Route::get('/laporan', [LaporanSampahController::class, 'index'])->name('laporan.index');
    Route::get('/export-laporan', [LaporanSampahController::class, 'exportPdf'])->name('laporan.export');
});

// User routes
Route::prefix('user')->middleware(['auth', 'role:member'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('user.transaksi');
    Route::get('/transaksi/filter', [TransaksiController::class, 'filter'])->name('user.transaksi.filter');
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('user.pengajuan');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('user.pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('user.pengajuan.store');
});
