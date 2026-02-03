<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Login page (guest)
Route::get('/', function () {
    return view('home');
})->middleware('guest');

// Auth routes
Auth::routes([
    'register' => false
]);

// Redirect after login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Dashboard routes (auth only)
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', \App\Http\Controllers\Dashboard\ProductController::class);

    // PINDAHKAN KE SINI agar URL-nya menjadi /dashboard/search/api
    Route::get('/search/api', [\App\Http\Controllers\SearchController::class, 'globalSearch'])->name('search.api');
});
