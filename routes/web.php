<?php

use App\Http\Controllers\ParkirController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Health check route (untuk Railway) - HARUS DI ATAS, TIDAK BUTUH DATABASE
Route::get('/health', function () {
    try {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toIso8601String()
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Public routes
Route::get('/', [ParkirController::class, 'index'])->name('home');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/data', [AdminController::class, 'data'])->name('data');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings']);
    });
});
