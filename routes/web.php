<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\TourController;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register',[AuthController::class, 'showRegisterForm'])->name('customer.register.form');

Route::get('/',[HomeController::class, 'index']);
Route::post('/register',[AuthController::class, 'registerCustomers'])->name('customer.register');

Route::get('/update-profile/{user}',[AuthController::class, 'updateProfileView'])->name('update-profile');
Route::post('/update-profile/{user}',[AuthController::class, 'updateProfileUser'])->name('user.update-profile');

Route::resource('/tours',TourController::class);
Route::resource('/reviews',ReviewController::class);
Route::resource('/cart',CartController::class);

Route::middleware('auth.customer')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
