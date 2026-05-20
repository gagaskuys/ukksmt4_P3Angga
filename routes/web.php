<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController; 
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\Auth\LoginController;

// 1. Rute Publik
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// 2. Rute yang butuh Login
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // --- FITUR KHUSUS ADMIN ---
    Route::middleware(['cekrole:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('petugas', PetugasController::class);
        Route::resource('kepsek', KepsekController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('jurusan', JurusanController::class);
    });

    // --- RUTE KHUSUS GURU ---
    Route::middleware(['cekrole:guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [AspirasiController::class, 'monitoring'])->name('dashboard');
        Route::get('/aspirasi', [AspirasiController::class, 'monitoring'])->name('aspirasi.index');
        Route::get('/laporan-selesai', [AspirasiController::class, 'monitoring'])->name('laporan.selesai');
    });

    // --- FITUR INPUT & RIWAYAT (SISWA, GURU, ADMIN) ---
    Route::middleware(['cekrole:siswa|guru|admin'])->group(function () {
        Route::get('/aspirasi/input', [AspirasiController::class, 'create'])->name('siswa.create');
        Route::post('/aspirasi/simpan', [AspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('/aspirasi/histori', [AspirasiController::class, 'history'])->name('aspirasi.history');
        Route::delete('/aspirasi/hapus/{id}', [AspirasiController::class, 'hapus'])->name('aspirasi.hapus');
    });

    // --- FITUR MONITORING (ADMIN, GURU, PETUGAS, KEPSEK) ---
    Route::middleware(['cekrole:admin|guru|petugas|kepsek'])->group(function () {
        Route::get('/aspirasi/monitoring', [AspirasiController::class, 'monitoring'])->name('aspirasi.monitoring');
        Route::post('/aspirasi/update-status/{id}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
        Route::get('/aspirasi/detail/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
    });

    // --- RUTE KHUSUS PETUGAS SARANA ---
Route::middleware(['cekrole:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [AspirasiController::class, 'monitoring'])->name('dashboard');
});
    
    // ✅ HAPUS ROUTE INI - JANGAN ADA!
    // Route::get('/img/{filename}', function ($filename) {});
});