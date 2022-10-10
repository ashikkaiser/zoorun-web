<?php

use App\Http\Controllers\Api\HomeController;
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

Route::group(['prefix' => 'web'], function () {
    Route::any('get_weight_package', [HomeController::class, 'get_weight_package']);
    Route::any('service_areas', [HomeController::class, 'service_areas']);
    Route::any('geta_areas', [HomeController::class, 'geta_areas']);
    Route::any('get_districts', [HomeController::class, 'get_districts']);
    Route::any('get_area', [HomeController::class, 'get_area']);
    Route::any('become_a_merchant', [HomeController::class, 'become_a_merchant']);
    Route::any('service_charge', [HomeController::class, 'get_service_charge']);
    Route::any('get_locations', [HomeController::class, 'get_locations']);
    Route::any('get_price', [HomeController::class, 'get_price']);
});
Route::group(['prefix' => 'merchant'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('create', [MerchantController::class, 'create']);
    Route::post('getarea', [MerchantController::class, 'getarea']);
    Route::post('getpickupaddress', [MerchantController::class, 'getpickupaddress']);
    Route::post('modifypickupaddress', [MerchantController::class, 'modifypickupaddress']);

    Route::post('newparcel', [MerchantController::class, 'newParcel']);
    Route::post('getParcels', [MerchantController::class, 'getParcels']);
    Route::post('orderTracking', [MerchantController::class, 'orderTracking']);
    Route::post('dashboard', [MerchantController::class, 'dashboard']);
    Route::post('getDeliveryParcelList', [MerchantController::class, 'getDeliveryParcelList']);
    Route::post('getDeliveryPaymentList', [MerchantController::class, 'getDeliveryPaymentList']);
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
