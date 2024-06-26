<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Host\AuthController;
use App\Http\Controllers\Host\HomeController;
use App\Http\Controllers\Host\TourController;
use App\Http\Controllers\Host\TourInfoController;
use App\Http\Controllers\Host\ScheduleController;
use App\Http\Controllers\Host\ReviewController;
use App\Http\Controllers\Host\BookTourController;
use App\Http\Controllers\Host\BillController;
use App\Http\Controllers\Host\AccommodationController;
use App\Http\Controllers\Host\AttractionController;
use App\Http\Controllers\Host\AccommodationImageController;
use App\Http\Controllers\Host\AttractionImageController;

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
    Route::resource('/bookings', BookTourController::class);
    Route::resource('/bills', BillController::class);
    Route::resource('/attractions', AttractionController::class);
    Route::resource('/accommodations', AccommodationController::class);
    Route::resource('/attraction-images', AttractionImageController::class)
        ->only(['destroy',]);
    Route::resource('/accommodation-images', AccommodationImageController::class)
        ->only(['destroy',]);
    Route::get('/export', [BillController::class, 'getListToExport'])->name('bills.export');
    Route::get('/export/pdf', [BillController::class, 'createPDF'])->name('bills.export.pdf');
    Route::put('/approve/{booking}', [BookTourController::class, 'approve'])->name('bookings.approve');
    Route::put('/cancel/{booking}', [BookTourController::class, 'cancel'])->name('bookings.cancel');
    Route::put('/finished/{booking}', [BookTourController::class, 'finishedConfirm'])->name('bookings.finished');
    Route::get('/tour-infos/list/{tour}', [TourInfoController::class, 'getListTourInfo'])->name('tour-infos.list');
    Route::resource('reviews', ReviewController::class);
});
