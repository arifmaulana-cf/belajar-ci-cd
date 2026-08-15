<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\PlantController;
use App\Http\Controllers\AuthController;

// Public Routes (Akses Pengunjung & Peneliti di Lapangan)

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/galeri', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/scan', [PublicController::class, 'scan'])->name('scan');
Route::get('/tentang-kami', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/tumbuhan/{kode_tumbuhan}', [PublicController::class, 'show'])->name('plant.detail');



// Admin Routes

// Route Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// |  (Manajemen Data & QR Code)

Route::prefix('admin')->name('admin.')->group(function () {
    
    // --- FITUR CETAK WORD (Sesuai Activity Diagram) ---
    // 1. Rute untuk Menampilkan Link Unduh
    Route::get('plants/export-ready/{type}/{id?}', [PlantController::class, 'exportReady'])->name('plants.export-ready');
    // 2. Rute untuk Notifikasi, Insert DB, dan Download
    Route::get('plants/export-download/{type}/{id?}', [PlantController::class, 'exportDownload'])->name('plants.export-download');
    // --------------------------------------------------

    Route::resource('plants', PlantController::class);
    Route::get('plants/{plant}/print-label', [PlantController::class, 'printLabel'])->name('plants.print-label');

});