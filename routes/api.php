<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\AttractionController;
use App\Http\Controllers\Api\AttractionImageController;
use App\Http\Controllers\Api\FileController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('districts', DistrictController::class)->only(['index', 'show',]);
Route::resource('attractions', AttractionController::class)->only(['show',]);
Route::resource('attraction-images', AttractionImageController::class)->only(['show',]);
Route::post('files/upload-crop-image', [FileController::class,'uploadCropImage'])->name('upload.crop-image');
