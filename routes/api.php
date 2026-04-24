<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/v1/register', [AuthController::class, 'register']);
Route::post('/v1/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('role:masyarakat')->group(function () {
        Route::get('/v1/masyarakat/profile', [AuthController::class, 'profile']);
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

    Route::post('/v1/logout', [AuthController::class, 'logout']);
});