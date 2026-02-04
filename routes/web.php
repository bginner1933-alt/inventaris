<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\KategoriController;
use App\Http\Controllers\Dashboard\BarangController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\PeminjamanController;
use App\Http\Controllers\Dashboard\PengaturanController;

// --- Public Routes ---
Route::get('/', function () {
    return view('home');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// --- Dashboard Routes ---
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    
    // Index Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Resource Routes (Otomatis mencakup index, create, store, show, edit, update, destroy)
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('users', UserController::class);

    // Lokasi (Dibuat resource agar lebih rapi dan fiturnya lengkap)
    Route::resource('location', LocationController::class)->names([
        'index' => 'location.index',
        'store' => 'location.store',
    ]);
    
    // Profile & Search
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/search/api', [SearchController::class, 'globalSearch'])->name('search.api');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});