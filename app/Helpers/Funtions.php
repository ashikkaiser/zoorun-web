<?php

use App\Models\Parcel;
use App\Models\RiderParcel;
use App\Models\RiderRun;

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
