<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController; // Dirapikan ke atas
use App\Http\Controllers\Dashboard\ProfileController; // Perbaikan: 'Dashboard' (D kapital)
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing/Login page
Route::get('/', function () {
    return view('home');
})->middleware('guest');

// Auth routes (Disable register)
Auth::routes(['register' => false]);

// Redirect standard setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Dashboard routes (auth only)
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    
    // URL: /dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // URL: /dashboard/users, /dashboard/category, /dashboard/product
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    
    // URL: /dashboard/search/api
    Route::get('/search/api', [SearchController::class, 'globalSearch'])->name('search.api');
    
    // PERBAIKAN: URL: /dashboard/profile
    // Cukup tulis 'profile', prefix 'dashboard' akan otomatis ditambahkan oleh grup
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
});