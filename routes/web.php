<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\BeritaController;
use Illuminate\Support\Facades\Route;

// Tambahkan import ini

Route::get('/beranda', [LandingPageController::class, 'index'])->name('landing'); // landing page
Route::redirect('/', '/beranda');

Route::get('/berita', [LandingPageController::class, 'indexBerita'])->name('user.berita.index');
Route::get('/berita/{id}', [LandingPageController::class, 'showBerita'])->name('user.berita.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register.view');
Route::post('/signup', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showAdminDashboard'])->name('admin.dashboard');
        Route::resource('users', UserController::class, ['as' => 'admin']);

        Route::resource('berita', BeritaController::class, ['as' => 'admin']);  
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
