<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\LaporanController as ApiLaporanController;

Route::post('/v1/register', [ApiAuthController::class, 'register']);
Route::post('/v1/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/v1/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('role:masyarakat')->group(function () {
        Route::get('/v1/masyarakat/profile', [ApiAuthController::class, 'profile']);
        Route::post('/v1/masyarakat/laporan', [ApiLaporanController::class, 'store']); 
        Route::get('/v1/masyarakat/laporan/history', [ApiLaporanController::class, 'index']); 
    });


    Route::middleware('role:pakar')->group(function () {
        Route::get('/v1/pakar/consultations', function() {
            return response()->json(['message' => 'Daftar konsultasi pakar']);
        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/v1/admin/users-list', function() {
            return \App\Models\User::all();
        });
    });

    Route::post('/v1/logout', [ApiAuthController::class, 'logout']);
});