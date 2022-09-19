<?php

use App\Http\Controllers\Api\Merchant\AuthController;
use App\Http\Controllers\Api\Merchant\MerchantController;
use App\Http\Controllers\Api\Rider\AuthController as RiderAuthController;
use App\Http\Controllers\Api\Rider\RiderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'merchant'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('create', [MerchantController::class, 'create']);
    Route::post('getarea', [MerchantController::class, 'getarea']);
});

Route::group(['prefix' => 'rider'], function () {
    Route::post('login', [RiderAuthController::class, 'login']);
    Route::post('logout', [RiderAuthController::class, 'logout']);
    Route::post('refresh', [RiderAuthController::class, 'refresh']);
    Route::post('me', [RiderAuthController::class, 'me']);
    Route::post('update_token', [RiderAuthController::class, 'updateToken']);
    Route::post('dashboard', [RiderController::class, 'dashboard']);
    // Percel Pickup
    Route::post('parcel/pickup/request', [RiderController::class, 'pickupRequest']);
    Route::post('parcel/pickup/modify', [RiderController::class, 'pickupModify']);
    Route::post('parcel/pickup/runing', [RiderController::class, 'pickupRunning']);
    // Parcel Delivery
    Route::post('parcel/delivery/request', [RiderController::class, 'deliveryRequest']);
    Route::post('parcel/delivery/modify', [RiderController::class, 'deliveryModify']);
    Route::post('parcel/delivery/runing', [RiderController::class, 'deliveryRunning']);

    //Parcel Return
    Route::post('parcel/return/request', [RiderController::class, 'returnRequest']);
    Route::post('parcel/return/modify', [RiderController::class, 'returnModify']);
    Route::post('parcel/return/runing', [RiderController::class, 'returnRunning']);
});
