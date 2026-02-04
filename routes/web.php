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

// 1. Halaman Depan / Landing Page
Route::get('/', function () {
    return view('home');
})->middleware('guest');

// 2. Auth Routes (Registrasi Dimatikan)
Auth::routes(['register' => false]);

// 3. Redirect Setelah Login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 4. Grup Dashboard (SATU GRUP SAJA)
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    
    // Dashboard Index
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Manajemen Master Data (Resource)
    Route::resource('kategori', KategoriController::class); // Route: dashboard.kategori.index
    Route::resource('barang', BarangController::class);     // Route: dashboard.barang.index
    Route::resource('users', UserController::class);       // Route: dashboard.users.index
    
    // Lokasi (Manual Route)
    Route::get('/location', [LocationController::class, 'index'])->name('location.index');
    Route::post('/location', [LocationController::class, 'store'])->name('location.store');
    
    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // API & Search
    Route::get('/search/api', [SearchController::class, 'globalSearch'])->name('search.api');
    Route::resource('peminjaman', PeminjamanController::class);
});