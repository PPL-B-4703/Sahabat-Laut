<?php

use App\Http\Controllers\PakarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController; // Tambahkan import ini

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register.view');
Route::post('/signup', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showAdminDashboard'])->name('admin.dashboard');
    });

    Route::middleware('role:pakar')->prefix('pakar')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showPakarDashboard'])->name('pakar.dashboard');
    });

    Route::middleware('role:masyarakat')->prefix('masyarakat')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showMasyarakatDashboard'])->name('dashboard');
        Route::get('/lapor', [LaporanController::class, 'create'])->name('laporan.create');
        Route::post('/lapor', [LaporanController::class, 'store'])->name('laporan.store');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('pakar')->group(function () {
    Route::get('/dashboard', [PakarController::class, 'dashboard'])->name('pakar.dashboard');
    Route::get('/validasi', [PakarController::class, 'index'])->name('pakar.validasi');
    Route::get('/validasi/{id}', [PakarController::class, 'show'])->name('pakar.detail');
    Route::post('/validasi/{id}/submit', [PakarController::class, 'update'])->name('pakar.submit');
});