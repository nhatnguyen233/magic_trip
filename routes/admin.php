<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AttractionController;
use App\Http\Controllers\Admin\AttractionImageController;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\AccommodationImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HostController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Route::middleware('auth.admin')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/', DashboardController::class)->only(['index', 'show']);;
    Route::resource('/categories', CategoriesController::class)
        ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/attractions', AttractionController::class)
            ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/accommodations', AccommodationController::class)
        ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/attraction-images', AttractionImageController::class)
        ->only(['destroy',]);
    Route::resource('/accommodation-images', AccommodationImageController::class)
        ->only(['destroy',]);
    Route::resource('users', UserController::class);
    Route::resource('/hosts', HostController::class);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('show_login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
