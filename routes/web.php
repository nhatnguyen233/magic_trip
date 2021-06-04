<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\TourController;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\BookTourController;
use App\Http\Controllers\Customer\LanguageController;
use App\Http\Controllers\Customer\SocialController;
use App\Http\Controllers\Customer\AccommodationController;
use App\Http\Controllers\Customer\AttractionController;
use App\Http\Controllers\Customer\EventController;

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

Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect'])->name('login.social');
Route::get('/callback/{provider}', [SocialController::class, 'callback'])->name('login.callback');

Route::get('/',[HomeController::class, 'index']);
Route::post('/register',[AuthController::class, 'register'])->name('customer.register');

Route::get('/update-profile/{user}',[AuthController::class, 'updateProfileView'])->name('update-profile');
Route::post('/update-profile/{user}',[AuthController::class, 'updateProfileUser'])->name('user.update-profile');

Route::get('/tours-grid',[TourController::class, 'getGridTours'])->name('tours.grid');
Route::get('language/{language}', [LanguageController::class, 'index'])->name('language.index');
Route::post('/cart/delete-all',[CartController::class, 'deleteAllCart'])->name('cart.deleteAll');

Route::resource('/tours',TourController::class);
Route::resource('/reviews',ReviewController::class);
Route::resource('/cart',CartController::class);
Route::resource('/accommodations', AccommodationController::class);
Route::resource('/attractions', AttractionController::class);
Route::resource('/events', EventController::class);

Route::middleware('auth.customer')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/book-tour', BookTourController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::get('/book-tour/order-pending', [BookTourController::class, 'getPendingOrderPage'])->name('book-tour.order-pending');
    Route::get('/book-tour/order-finished', [BookTourController::class, 'getFinishedOrderPage'])->name('book-tour.order-finished');
    Route::get('/book-tour/order-payment', [BookTourController::class, 'getPaymentOrderPage'])->name('book-tour.order-payment');
    Route::put('/book-tour/order-payment', [BookTourController::class, 'paymentBooking'])->name('book-tour.payment');

});
