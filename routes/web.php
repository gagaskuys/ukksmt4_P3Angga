<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\Auth\LoginController;

// 1. Rute Auth (Publik)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// --- PERBAIKAN LOGOUT ---
// Jika kamu ingin logout gampang tanpa error "Method Not Allowed", 
// gunakan GET saja untuk sementara selama pengerjaan UKK ini.
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 

// 2. Rute yang butuh Login
Route::middleware(['auth'])->group(function () {
    
    // Halaman Utama: Langsung arahkan ke dashboard
    Route::get('/', [AdminController::class, 'index'])->name('home');

    // Fitur No 12-19: KHUSUS ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
    });

    // Fitur No 3-7: KHUSUS SISWA & ADMIN
    Route::middleware(['role:siswa|admin'])->group(function () {
        Route::get('/aspirasi/input', [AspirasiController::class, 'create'])->name('aspirasi.create');
    });

    // Fitur No 8-11: GURU, PETUGAS, KEPSEK, ADMIN
    Route::middleware(['role:admin|guru|petugas|kepsek'])->group(function () {
        Route::get('/aspirasi/lihat', [AspirasiController::class, 'index'])->name('aspirasi.index');
    });
});
