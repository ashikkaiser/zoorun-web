<?php

use App\Http\Controllers\Admin\Application\AreaController;
use App\Http\Controllers\Admin\Application\DistrictController;
use App\Http\Controllers\Admin\Application\ServiceAreaController;
use App\Http\Controllers\Admin\Application\ServiceAreaSettingController;
use App\Http\Controllers\Admin\Application\ZoneController;
use App\Http\Controllers\Admin\Application\WeightPackageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Team\MerchantController;
use App\Http\Controllers\Admin\ParcelSettingController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\Team\BranchController;
use App\Http\Controllers\Admin\Team\RiderController;
use App\Http\Controllers\Admin\Team\WarehouseController;
use App\Http\Controllers\Branch\AccountsController;
use App\Http\Controllers\Branch\DeliveryParcelController;
use App\Http\Controllers\Branch\ParcelBookingController;
use App\Http\Controllers\Branch\ParcelSettingController as BranchParcelSettingController;
use App\Http\Controllers\Branch\PickupParcelController;
use App\Http\Controllers\Branch\ReturnParcelController;
use App\Http\Controllers\Merchant\AccountController;
use App\Http\Controllers\Merchant\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\DashboardController as MerchantDashboardController;
use App\Http\Controllers\Merchant\PageController;
use App\Http\Controllers\Merchant\PickupPointController;
use App\Http\Controllers\Merchant\ProfileController;
use App\Http\Controllers\Rider\ParcelController;
use App\Http\Controllers\Rider\ProfileController as RiderProfileController;
use App\Http\Controllers\Rider\RiderDashboardController;
use App\Http\Controllers\Warehouse\BookingController as WarehouseBookingController;
use App\Http\Controllers\Warehouse\ProfileController as WarehouseProfileController;
use App\Http\Controllers\Warehouse\TransfarController;
use App\Http\Controllers\Warehouse\WarehouseDashboardController;

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

Route::get("/", function () {
    return view("frontend.index");
});
Route::get("/enterprise", function () {
    return view("frontend.index");
});
Route::get("/courier", function () {
    return view("frontend.index");
});
Route::get("/signin", function () {
    return view("frontend.index");
});
Route::get("/coverage-area", function () {
    return view("frontend.index");
});
Route::get("/become-a-merchant", function () {
    return view("frontend.index");
});



Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginStore'])->name('loginStore');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


//Admin Route
Route::prefix('admin')->group(function () {

    //TODO:: move into controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("admin.dashboard");

    Route::group(['prefix' => 'team', 'as' => 'admin.team.'], function () {
        Route::get('branch', [BranchController::class, 'index'])->name("branch");
        Route::get('branch/create', [BranchController::class, 'create'])->name("branch.create");
        Route::post('branch/store', [BranchController::class, 'store'])->name("branch.store");
        Route::get('branch/edit/{id}', [BranchController::class, 'edit'])->name("branch.edit");
        Route::post('branch/update/{id}', [BranchController::class, 'update'])->name("branch.update");
        Route::get('branch/delete', [BranchController::class, 'destroy'])->name("branch.delete");

        Route::get('branch/users', [BranchController::class, 'branchUsers'])->name("branch.users");
        Route::get('branch/users/create', [BranchController::class, 'branchUsersCreate'])->name("branch.users.create");
        Route::post('branch/users/create', [BranchController::class, 'branchUsersStore'])->name("branch.users.store");
        Route::get('branch/users/delete', [BranchController::class, 'branchUsers'])->name("branch.users.delete");



        //marchant
        Route::get('/merchant', [MerchantController::class, 'index'])->name("merchant");
        Route::get('/merchant/add-new', [MerchantController::class, 'create'])->name("merchant.create");
        Route::post('/merchant/modify', [MerchantController::class, 'modify'])->name("merchant.modify");
        Route::get('/merchant/edit/{id}', [MerchantController::class, 'edit'])->name("merchant.edit");
        //Rider
        Route::get('/riders', [RiderController::class, 'index'])->name("rider");
        Route::get('/rider/add-new', [RiderController::class, 'create'])->name("rider.create");
        Route::post('/rider/modify', [RiderController::class, 'modify'])->name("rider.modify");
        Route::get('/rider/edit/{id}', [RiderController::class, 'edit'])->name("rider.edit");
        //warehouse
        Route::get('/warehouse', [WarehouseController::class, 'index'])->name("warehouse");
        Route::get('/warehouse/add-new', [WarehouseController::class, 'create'])->name("warehouse.create");
        Route::post('/warehouse/modify', [WarehouseController::class, 'modify'])->name("warehouse.modify");
        Route::get('/warehouse/edit/{id}', [WarehouseController::class, 'edit'])->name("warehouse.edit");
        Route::get('warehouse/delete', [WarehouseController::class, 'destroy'])->name("warehouse.delete");
        //warehouse User
        Route::get('warehouse/user', [WarehouseController::class, 'user'])->name("warehouse.user");
        Route::get('warehouse/user/add-new', [WarehouseController::class, 'userCreate'])->name("warehouse.user.create");
        Route::post('warehouse/user/modify', [WarehouseController::class, 'userModify'])->name("warehouse.user.modify");
        Route::get('warehouse/user/edit/{id}', [WarehouseController::class, 'userEdit'])->name("warehouse.user.edit");
        Route::get('warehouse/user/delete', [WarehouseController::class, 'userDestroy'])->name("warehouse.user.delete");
    });
    Route::group(['prefix' => 'application', 'as' => 'admin.application.'], function () {
        Route::get('districts', [DistrictController::class, 'index'])->name("district");
        Route::post('district/store', [DistrictController::class, 'store'])->name("district.store");
        Route::post('district/update/{id}', [DistrictController::class, 'update'])->name("district.update");
        Route::get('district/delete', [DistrictController::class, 'destroy'])->name("district.delete");

        Route::get('zones', [ZoneController::class, 'index'])->name("zone");
        Route::post('zone/store', [ZoneController::class, 'store'])->name("zone.store");
        Route::post('zone/update/{id}', [ZoneController::class, 'update'])->name("zone.update");
        Route::get('zone/delete', [ZoneController::class, 'destroy'])->name("zone.delete");

        Route::get('areas', [AreaController::class, 'index'])->name("area");
        Route::get('areas/getzone', [AreaController::class, 'getzone'])->name("getzone");
        Route::get('areas/getarea', [AreaController::class, 'getarea'])->name("getarea");

        Route::post('area/store', [AreaController::class, 'store'])->name("area.store");
        Route::post('area/update/{id}', [AreaController::class, 'update'])->name("area.update");
        Route::get('area/delete', [AreaController::class, 'destroy'])->name("area.delete");


        Route::get('weight-packages', [WeightPackageController::class, 'index'])->name("weight.package");
        Route::post('weight-package/store', [WeightPackageController::class, 'store'])->name("weight.package.store");
        Route::post('weight-package/update/{id}', [WeightPackageController::class, 'update'])->name("weight.package.update");
        Route::get('weight-package/delete', [WeightPackageController::class, 'destroy'])->name("weight.package.delete");

        Route::get('service-areas', [ServiceAreaController::class, 'index'])->name("service.area");
        Route::post('service-area/store', [ServiceAreaController::class, 'store'])->name("service.area.store");
        Route::post('service-area/update/{id}', [ServiceAreaController::class, 'update'])->name("service.area.update");
        Route::get('service-area/delete', [ServiceAreaController::class, 'destroy'])->name("service.area.delete");


        Route::get('service-area-settings', [ServiceAreaSettingController::class, 'index'])->name("service.area.setting");
        Route::get('service-area-setting/create', [ServiceAreaSettingController::class, 'create'])->name("service.area.setting.create");
        Route::post('service-area-setting/create', [ServiceAreaSettingController::class, 'store'])->name("service.area.setting.store");
        Route::get('service-area-setting/delete', [ServiceAreaSettingController::class, 'destroy'])->name("service.area.setting.delete");
        Route::get('service-area-setting/edit/{id}', [ServiceAreaSettingController::class, 'edit'])->name("service.area.setting.edit");
        Route::post('service-area-setting/edit/{id}', [ServiceAreaSettingController::class, 'update'])->name("service.area.setting.update");
    });


    Route::get('/parcel-setting/vehicles', [ParcelSettingController::class, 'vihicle'])->name("admin.parcel.setting.vehicle");
    Route::post('/parcel-setting/vehicle/store', [ParcelSettingController::class, 'vihiclestore'])->name("admin.parcel.setting.vehicle.store");
    Route::post('/parcel-setting/vehicle/update/{id}', [ParcelSettingController::class, 'vihicleupdate'])->name("admin.parcel.setting.vehicle.update");
    Route::get('/parcel-setting/vehicle/delete', [ParcelSettingController::class, 'vihicledestroy'])->name("admin.parcel.setting.vehicle.delete");

    Route::get('/parcel-setting/units', [ParcelSettingController::class, 'unit'])->name("admin.parcel.setting.unit");
    Route::post('/parcel-setting/unit/store', [ParcelSettingController::class, 'unitstore'])->name("admin.parcel.setting.unit.store");
    Route::post('/parcel-setting/unit/update/{id}', [ParcelSettingController::class, 'unitupdate'])->name("admin.parcel.setting.unit.update");
    Route::get('/parcel-setting/unit/delete', [ParcelSettingController::class, 'unitdestroy'])->name("admin.parcel.setting.unit.delete");

    Route::get('/parcel-setting/item-category', [ParcelSettingController::class, 'itemcategory'])->name("admin.parcel.setting.item.category");
    Route::post('/parcel-setting/item-category/store', [ParcelSettingController::class, 'itemcategorystore'])->name("admin.parcel.setting.item.category.store");
    Route::post('/parcel-setting/item-category/update/{id}', [ParcelSettingController::class, 'itemcategoryupdate'])->name("admin.parcel.setting.item.category.update");
    Route::get('/parcel-setting/item-category/delete', [ParcelSettingController::class, 'itemcategorydestroy'])->name("admin.parcel.setting.item.category.delete");

    Route::get('/parcel-setting/item', [ParcelSettingController::class, 'item'])->name("admin.parcel.setting.item");
    Route::post('/parcel-setting/item/store', [ParcelSettingController::class, 'itemstore'])->name("admin.parcel.setting.item.store");
    Route::post('/parcel-setting/item/update/{id}', [ParcelSettingController::class, 'itemupdate'])->name("admin.parcel.setting.item.update");
    Route::get('/parcel-setting/item/delete', [ParcelSettingController::class, 'itemdestroy'])->name("admin.parcel.setting.item.delete");

    Route::get('site-setting', [SiteSettingController::class, 'index'])->name("site.setting");
    Route::post('site-setting/store', [SiteSettingController::class, 'store'])->name("site.setting.store");
});
//Branch Route
Route::group(
    ['prefix' => 'branch', 'as' => 'branch.', 'middleware' => ['branch']],
    function () {
        Route::get('/dashboard', [\App\Http\Controllers\Branch\DashboardController::class, 'index'])->name("dashboard");
        Route::get('/profile', [\App\Http\Controllers\Branch\ProfileController::class, 'index'])->name('profile');
        Route::get('/order/tracking', [\App\Http\Controllers\Branch\PageController::class, 'orderTrack'])->name('order.track');
        Route::get('/merchant/list-by-branch', [\App\Http\Controllers\Branch\PageController::class, 'merchantList'])->name('merchant.list');
        Route::get('/rider/list-by-branch', [\App\Http\Controllers\Branch\PageController::class, 'riderList'])->name('rider.list');
        Route::get('/transfer/list', [\App\Http\Controllers\Branch\BranchTransferController::class, 'index'])->name('transfer.list');
        Route::group(['prefix' => 'parcel', 'as' => 'parcel.'], function () {
            Route::get('pickup/list', [PickupParcelController::class, 'index'])->name('pickup.list');
            Route::get('pickup/pacel/view/{id}', [PickupParcelController::class, 'viewModal'])->name('pickup.viewModal');
            Route::post('pickup/status/{id}', [PickupParcelController::class, 'modifyStatus'])->name('pickup.status');
            Route::get('pickup/generate', [PickupParcelController::class, 'generate'])->name('pickup.generate');
            Route::post('pickup/generate/store', [PickupParcelController::class, 'storeRiderRun'])->name('pickup.generate.store');
            Route::post('pickup/generate/start/{id}', [PickupParcelController::class, 'riderRunStart'])->name('pickup.generate.start');
            Route::get('pickup/rider/list', [PickupParcelController::class, 'pickupRiderList'])->name('pickup.rider.list');
            Route::get('pickup/transfer/generate', [PickupParcelController::class, 'generateBranchTransfer'])->name('transfer.generate');
            // Route::get('pickup/transfer/list', [PickupParcelController::class, 'deliveryBrachTransferList'])->name('transfer.list');

            //Delivery Parcel
            Route::get('delivery/list', [DeliveryParcelController::class, 'index'])->name('delivery.list');
            Route::post('delivery/status/{id}', [DeliveryParcelController::class, 'modifyStatus'])->name('delivery.status');

            Route::get('delivery/generate', [DeliveryParcelController::class, 'generate'])->name('delivery.generate');
            Route::get('delivery/rider/list', [DeliveryParcelController::class, 'deliveryRiderList'])->name('delivery.rider.list');

            //Booking Parcel
            Route::get('booking/list', [ParcelBookingController::class, 'index'])->name('booking.list');
            Route::get('booking/create', [ParcelBookingController::class, 'create'])->name('booking.create');
        });
        Route::group(['prefix' => 'return-parcel', 'as' => 'return.'], function () {
            Route::get('parcel-list', [ReturnParcelController::class, 'returnParcelList'])->name('parcel.list');
            Route::get('rider-list', [ReturnParcelController::class, 'returnRiderList'])->name('rider.list');
            Route::post('status/{id}', [ReturnParcelController::class, 'modifyStatus'])->name('modifyStatus');
        });

        Route::group(['prefix' => 'parcel-setting', 'as' => 'parcel.setting.'], function () {
            Route::get('vehicles', [BranchParcelSettingController::class, 'vihicle'])->name("vehicle");
            Route::post('vehicle/store', [BranchParcelSettingController::class, 'vihiclestore'])->name("vehicle.store");
            Route::post('vehicle/update/{id}', [BranchParcelSettingController::class, 'vihicleupdate'])->name("vehicle.update");
            Route::get('vehicle/delete', [BranchParcelSettingController::class, 'vihicledestroy'])->name("vehicle.delete");
            Route::get('units', [BranchParcelSettingController::class, 'unit'])->name("unit");
            Route::post('unit/store', [BranchParcelSettingController::class, 'unitstore'])->name("unit.store");
            Route::post('unit/update/{id}', [BranchParcelSettingController::class, 'unitupdate'])->name("unit.update");
            Route::get('unit/delete', [BranchParcelSettingController::class, 'unitdestroy'])->name("unit.delete");
            Route::get('item-category', [BranchParcelSettingController::class, 'itemcategory'])->name("item.category");
            Route::post('item-category/store', [BranchParcelSettingController::class, 'itemcategorystore'])->name("item.category.store");
            Route::post('item-category/update/{id}', [BranchParcelSettingController::class, 'itemcategoryupdate'])->name("item.category.update");
            Route::get('item-category/delete', [BranchParcelSettingController::class, 'itemcategorydestroy'])->name("item.category.delete");
            Route::get('item', [BranchParcelSettingController::class, 'item'])->name("item");
            Route::post('item/store', [BranchParcelSettingController::class, 'itemstore'])->name("item.store");
            Route::post('item/update/{id}', [BranchParcelSettingController::class, 'itemupdate'])->name("item.update");
            Route::get('item/delete', [BranchParcelSettingController::class, 'itemdestroy'])->name("item.delete");
        });

        Route::group(['prefix' => 'accounts', 'as' => 'accounts.'], function () {
            Route::get('/delivery-payment-list', [AccountsController::class, 'branchDeliveryPaymentList'])->name("delivery.payment.list");
            Route::get('/merchant-delivery-payment', [AccountsController::class, 'merchantDeliveryPayment'])->name("merchant.delivery.payment");
            Route::get('/merchant-delivery-payment-list', [AccountsController::class, 'merchantDeliveryPaymentList'])->name("merchant.delivery.payment.list");
        });
    }
);
//Merchant Route
Route::group(['prefix' => 'merchant', 'as' => 'merchant.', 'middleware' => ['merchant']], function () {
    Route::get('/dashboard', [MerchantDashboardController::class, 'index'])->name("dashboard");
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/parcel/booking/list', [BookingController::class, 'index'])->name('parcel.booking.list');
    Route::get('/parcel/booking/add', [BookingController::class, 'create'])->name('parcel.booking.create');
    Route::post('/parcel/booking/save', [BookingController::class, 'store'])->name('parcel.booking.store');
    Route::get('/parcel/booking/printLabel/{id}', [BookingController::class, 'generatePrintLabels'])->name('parcel.booking.generatePrintLabels');

    Route::get('/parcel/booking/cancel/{id}', [BookingController::class, 'cancelPickup'])->name('parcel.booking.cancel');
    Route::get('/parcel/booking/hold/{id}', [BookingController::class, 'holdParcel'])->name('parcel.booking.hold');
    Route::get('/parcel/booking/return/{id}', [BookingController::class, 'requestReturn'])->name('parcel.booking.requestReturn');


    Route::get('/account/delivery/payment/list', [AccountController::class, 'deliveryPaymentList'])->name('account.delivery.payment.list');
    Route::get('/account/delivery/parcel/list', [AccountController::class, 'deliveryParcelList'])->name('account.delivery.parcel.list');
    Route::get('/order/tracking', [PageController::class, 'orderTrack'])->name('order.track');
    Route::get('/coverage/area', [PageController::class, 'coverageArea'])->name('coverage.area');
    Route::get('/service/charge', [PageController::class, 'serviceCharge'])->name('service.charge');
    Route::get('/pickup/point', [PickupPointController::class, 'index'])->name('pickup.point');
    Route::post('/pickup/point/store', [PickupPointController::class, 'store'])->name('pickup.point.store');
    Route::any('/ajax/get_weight_package', [BookingController::class, 'get_weight_package'])->name('ajax.get_weight_package');
    Route::any('/ajax/get_weight_packages', [BookingController::class, 'get_weight_packages'])->name('ajax.get_weight_packages');
    Route::any('/ajax/get_total_calculation', [BookingController::class, 'get_total_calculation'])->name('ajax.get_total_calculation');
    Route::get('/ajax/get_area_by_zip', [BookingController::class, 'get_area_by_zip'])->name('ajax.get_area_by_zip');
});
//Rider Route
Route::group(['prefix' => 'rider', 'as' => 'rider.'], function () {
    Route::get('/dashboard', [RiderDashboardController::class, 'index'])->name("dashboard");
    Route::get('/profile', [RiderProfileController::class, 'index'])->name('profile');
    Route::get('/parcel/pickup', [ParcelController::class, 'pickup'])->name('parcel.pickup');
    Route::post('/parcel/pickup/status/{id}', [ParcelController::class, 'pickupStatus'])->name('parcel.pickup.status');
    Route::get('/parcel/pickup/viewParcel/{id}', [ParcelController::class, 'viewParcel'])->name('parcel.viewParcel');
    Route::any('/parcel/pickup/confirmParcel/{id}', [ParcelController::class, 'confirmParcel'])->name('parcel.confirmParcel');
    Route::get('/parcel/pickup/rescheduleParcel/{id}', [ParcelController::class, 'rescheduleParcel'])->name('parcel.rescheduleParcel');

    Route::get('/parcel/delivery/viewParcel/{id}', [ParcelController::class, 'deliveryViewParcel'])->name('parcel.delivery.viewParcel');
    Route::any('/parcel/delivery/confirmParcel/{id}', [ParcelController::class, 'deliveryConfirmParcel'])->name('parcel.delivery.confirmParcel');
    Route::get('/parcel/delivery/rescheduleParcel/{id}', [ParcelController::class, 'deliveryRescheduleParcel'])->name('parcel.delivery.rescheduleParcel');
    Route::get('/parcel/delivery', [ParcelController::class, 'delivery'])->name('parcel.delivery');
    Route::post('/parcel/delivery/status/{id}', [ParcelController::class, 'deliveryStatus'])->name('parcel.delivery.status');
    Route::post('/parcel/delivery/sendotp', [ParcelController::class, 'sendDeliveryOtp'])->name('parcel.delivery.sendotp');
    Route::post('/parcel/delivery/verifyOtp', [ParcelController::class, 'deliveryVerifyOtp'])->name('parcel.delivery.otpverify');
    Route::get('/parcel/return', [ParcelController::class, 'return'])->name('parcel.return');
});
//warehouse Route
Route::group(['prefix' => 'warehouse', 'as' => 'warehouse.'], function () {
    Route::get('/dashboard', [WarehouseDashboardController::class, 'index'])->name("dashboard");
    Route::get('/profile', [WarehouseProfileController::class, 'index'])->name('profile');
    Route::get('/booking/parcel', [WarehouseBookingController::class, 'index'])->name('booking.parcel');
    Route::get('/booking/parcel/viewParcel/{id}', [WarehouseBookingController::class, 'viewParcel'])->name('booking.parcel.viewParcel');
    Route::post('/booking/dispatchWarehouse', [WarehouseBookingController::class, 'dispatchWarehouse'])->name('booking.dispatch');
    Route::post('/booking/ajax_get_parcels_by_riders', [WarehouseBookingController::class, 'ajax_get_parcels_by_riders'])->name('booking.ajax_get_parcels_by_riders');
    Route::get('/booking/operation', [WarehouseBookingController::class, 'operation'])->name('booking.operation');
    Route::get('/booking/return_operation', [WarehouseBookingController::class, 'returnOperation'])->name('booking.returnOperation');
    Route::get('/transfar/send/operation', [TransfarController::class, 'send'])->name('transfar.send.operation');
    Route::get('/transfar/recieve/operation', [TransfarController::class, 'recieve'])->name('transfar.recieve.operation');
});
Route::get('/lost', function () {
    return view('themes.frest.extra.lost');
})->name('lost');
