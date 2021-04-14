<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Host\AuthController;
use App\Http\Controllers\Host\HomeController;
use App\Http\Controllers\Host\TourController;
use App\Http\Controllers\Host\TourInfoController;
use App\Http\Controllers\Host\ScheduleController;
use App\Http\Controllers\Host\ReviewController;

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
Route::get('/register',[AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::get('/schedules/tour/{tour}', [ScheduleController::class, 'getTourSchedules'])->name('schedules.tour');

Route::middleware('auth.host')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/', HomeController::class)->only(['index', 'show']);;
    Route::resource('/tours', TourController::class);
    Route::resource('/tour-infos', TourInfoController::class);
    Route::resource('/schedules', ScheduleController::class);
    Route::get('/tour-infos/list/{tour}', [TourInfoController::class, 'getListTourInfo'])->name('tour-infos.list');
    Route::resource('reviews', ReviewController::class);
});
