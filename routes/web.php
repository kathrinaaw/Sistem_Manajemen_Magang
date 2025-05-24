<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\MagangController as MahasiswaMagangController;
use App\Http\Controllers\Mahasiswa\PerusahaanController as MahasiswaPerusahaanController;
use App\Http\Controllers\Mahasiswa\PembimbingController as MahasiswaPembimbingController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Mahasiswa Routes
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    
    // Magang Routes
    Route::get('/magang', [MahasiswaMagangController::class, 'index'])->name('magang.index');
    Route::get('/magang/create', [MahasiswaMagangController::class, 'create'])->name('magang.create');
    Route::post('/magang', [MahasiswaMagangController::class, 'store'])->name('magang.store');
    Route::get('/magang/{id}', [MahasiswaMagangController::class, 'show'])->name('magang.show');
    Route::get('magang/{id}/download-pdf', [\App\Http\Controllers\Mahasiswa\MagangController::class, 'downloadPdf'])->name('magang.downloadPdf');
    // Route::get('/mahasiswa/magang/{id}/download-pdf', [MagangController::class, 'downloadPdf'])->name('mahasiswa.magang.downloadPdf');

    // Perusahaan Routes (untuk mahasiswa lihat data perusahaan)
    Route::get('/perusahaan', [MahasiswaPerusahaanController::class, 'index'])->name('perusahaan.index');
    Route::get('/perusahaan/{id}', [MahasiswaPerusahaanController::class, 'show'])->name('perusahaan.show');
    
    // Pembimbing Routes (untuk mahasiswa lihat data pembimbing)
    Route::get('/pembimbing', [MahasiswaPembimbingController::class, 'index'])->name('pembimbing.index');
    Route::get('/pembimbing/{nidn}', [MahasiswaPembimbingController::class, 'show'])->name('pembimbing.show');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('perusahaan', \App\Http\Controllers\Admin\PerusahaanController::class);
    Route::resource('pembimbing', \App\Http\Controllers\Admin\PembimbingController::class);
    Route::resource('magang', \App\Http\Controllers\Admin\MagangController::class);
});

// Logout route (bisa dipake admin & mahasiswa)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');