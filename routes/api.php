<?php

use App\Http\Controllers\ParkirController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('/kendaraan', [ParkirController::class, 'getKendaraan'])->name('kendaraan');
    Route::post('/tambah-parkir', [ParkirController::class, 'tambahParkir'])->name('tambah-parkir');
    Route::post('/keluar-parkir', [ParkirController::class, 'keluarParkir'])->name('keluar-parkir');
    Route::get('/tarif', [ParkirController::class, 'getTarif'])->name('tarif');
    Route::get('/riwayat', [ParkirController::class, 'getRiwayat'])->name('riwayat');
    Route::post('/update-status', [ParkirController::class, 'updateStatus'])->name('update-status');
});

