<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatalogController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register.view');
Route::post('/signup', [AuthController::class, 'register'])->name('register');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{biota}', [KatalogController::class, 'show'])->name('katalog.show');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showAdminDashboard'])->name('admin.dashboard');
    });

    Route::middleware('role:pakar')->prefix('pakar')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showPakarDashboard'])->name('pakar.dashboard');
    });

    Route::middleware('role:masyarakat')->prefix('masyarakat')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showMasyarakatDashboard'])->name('dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});