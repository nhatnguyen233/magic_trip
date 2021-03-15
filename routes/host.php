<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Host\AuthController;
use App\Http\Controllers\Host\HomeController;
/*
|--------------------------------------------------------------------------
| Host Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "host" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('show_login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth.host')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/', HomeController::class)->only(['index', 'show']);;
});
