<?php

use App\Models\Parcel;
use App\Models\ParcelStatus;
use App\Models\RiderParcel;
use App\Models\RiderRun;
use App\Models\SiteSetting;

function riderRunStart($riderRun, $parcel_id)
{

    $rider = new RiderParcel();
    $rider->rider_run_id = $riderRun->id;
    $rider->type = $riderRun->run_type;
    $rider->parcel_id = $parcel_id;
    $rider->rider_id = $riderRun->rider_id;
    $rider->status = $riderRun->status;
    $rider->save();
    return $rider;
}


function riderRunEnd($parcel_id)
{
    $run = RiderRun::find($parcel_id);
    $parcelCount = Parcel::where('pickup_rider_run_id', $parcel_id)->where('status', 'received-to-warehouse')->count();
    if ($parcelCount === $run->rider_parcel->count()) {
        $run->status = 3;
        $run->rider_parcel->status = 3;
        $run->push();
    }
    return 0;
}
function riderRunStartFromWarehouse($parcel_id)
{
}


function riderDeliveryEnd($rider_id)
{
    $run = RiderRun::find($rider_id);
    $parcelCount = Parcel::where('delivery_rider_run_id', $rider_id)->where('status', 'delivery-completed')->count();
    if ($parcelCount === $run->rider_parcel->count()) {
        $run->status = 3;
        $run->rider_parcel->status = 3;
        $run->push();
    }
    return 0;
}
function riderReturnDeliveryEnd($rider_id)
{
    $run = RiderRun::find($rider_id);
    $parcelCount = Parcel::where('return_delivery_rider_run_id', $rider_id)->where('status', 'return-delivery-completed')->count();
    if ($parcelCount === $run->rider_parcel->count()) {
        $run->status = 3;
        $run->rider_parcel->status = 3;
        $run->push();
    }
    return 0;
}
function riderReturnPickupEnd($rider_id)
{
    $run = RiderRun::find($rider_id);
    $parcelCount = Parcel::where('return_pickup_rider_run_id', $rider_id)->where('status', 'return-pickup-completed')->count();
    if ($parcelCount === $run->rider_parcel->count()) {
        $run->status = 3;
        $run->rider_parcel->status = 3;
        $run->push();
    }
    return 0;
}



function return_type($parcel)
{
    $currentStatus = ParcelStatus::where('key', $parcel->status)->first()->group;

    if ($currentStatus === 'pickup') {
        return  'return_delivery_rider_run_id';
    }
    if ($currentStatus === 'delivery') {
        return 'return_pickup_rider_run_id';
    }
}

function type($status, $type)
{
    $packup = ParcelStatus::where('key', $status)->first()->group;
    if ($type === 'accept') {
        if ($packup === 'delivery') {
            return 'return-pickup-in-progress';
        }
        if ($packup === 'pickup') {
            return 'return-delivery-in-progress';
        }
    }
    if ($type === 'confirm') {
        if ($packup === 'delivery') {
            return 'return-pickup-completed';
        }
        if ($packup === 'pickup') {
            return 'return-delivery-completed';
        }
    }
    if ($type === 'request') {
        if ($packup === 'delivery') {
            return 'return-pickup-requested';
        }
        if ($packup === 'pickup') {
            return 'return-delivery-requested';
        }
    }
}


function settings()
{
    return  SiteSetting::first();
}
