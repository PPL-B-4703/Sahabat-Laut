<?php

use App\Http\Controllers\PakarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistikController;


Route::get('/beranda', [LandingPageController::class, 'index'])->name('landing'); 
Route::redirect('/', '/beranda');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register.view');
Route::post('/signup', [AuthController::class, 'register'])->name('register');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/{biota}', [KatalogController::class, 'show'])->name('katalog.show');
Route::view('/regulasi', 'regulasi')->name('regulasi');


Route::middleware(['auth'])->group(function () {
    
    Route::get('/export/katalog/pdf', [App\Http\Controllers\KatalogController::class, 'exportPdf'])->name('katalog.export.pdf');
    Route::get('/export/katalog/csv', [App\Http\Controllers\KatalogController::class, 'generateCsv'])->name('katalog.generate.csv');

    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.markAsRead');

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showAdminDashboard'])->name('admin.dashboard');
    });

    Route::middleware('role:pakar')->prefix('pakar')->group(function () {
        Route::get('/dashboard', [PakarController::class, 'showPakarDashboard'])->name('pakar.dashboard');
        Route::get('/validasi', [PakarController::class, 'index'])->name('pakar.validasi');
        Route::get('/validasi/{id}', [PakarController::class, 'show'])->name('pakar.validasi.show');
        Route::post('/validasi/{id}/submit', [PakarController::class, 'update'])->name('pakar.submit');
        Route::get('/profile', [PakarController::class, 'editProfile'])->name('pakar.profile');
        Route::patch('/validasi/{id}', [PakarController::class, 'updateStatus'])->name('pakar.validasi.update');
        Route::post('/validasi/bulk-verify', [App\Http\Controllers\PakarController::class, 'bulkVerify'])->name('pakar.validasi.bulk');
    });

    Route::middleware('role:masyarakat')->prefix('masyarakat')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'showMasyarakatDashboard'])->name('dashboard');
        Route::get('/profil', [ProfileController::class, 'edit'])->name('masyarakat.profil.edit');
        Route::put('/profil', [ProfileController::class, 'update'])->name('masyarakat.profil.update');
        Route::get('/lapor', [LaporanController::class, 'create'])->name('laporan.create');
        Route::post('/lapor', [LaporanController::class, 'store'])->name('laporan.store');
        Route::get('/riwayat', [LaporanController::class, 'index'])->name('laporan.history');
        Route::get('/lapor/{id}', [LaporanController::class, 'show'])->name('laporan.show');
        Route::get('/statistik', [StatistikController::class, 'index'])->name('masyarakat.statistik');
        
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
