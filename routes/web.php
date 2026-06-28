<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\MandorController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    // Pimpinan Routes
    Route::middleware(['role:pimpinan'])->prefix('pimpinan')->name('pimpinan.')->group(function () {
        Route::get('/dashboard', [PimpinanController::class, 'dashboard'])->name('dashboard');
        Route::get('/tracking', [PimpinanController::class, 'tracking'])->name('tracking');
        Route::get('/absensi', [PimpinanController::class, 'absensi'])->name('absensi');
        Route::get('/laporan', [PimpinanController::class, 'laporan'])->name('laporan');
        Route::get('/pengaturan', [PimpinanController::class, 'pengaturan'])->name('pengaturan');
    });

    // Mandor Routes
    Route::middleware(['role:mandor'])->prefix('mandor')->name('mandor.')->group(function () {
        Route::get('/dashboard', [MandorController::class, 'dashboard'])->name('dashboard');
        Route::get('/profil', [MandorController::class, 'profil'])->name('profil');
        Route::post('/absen-masuk', [MandorController::class, 'absenMasuk'])->name('absen.masuk');
        Route::post('/absen-pulang', [MandorController::class, 'absenPulang'])->name('absen.pulang');
    });

});
