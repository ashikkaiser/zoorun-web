<?php

namespace App\Models;

use App\Models\Scopes\PickupAddressByMerchant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use \Awobaz\Compoships\Compoships;
    public static function boot()
    {
        parent::boot();
    }

    public function scopeBranch($query)
    {
        return $query->where('branch_id', auth()->user()->branch_id);
    }
    public function scopeMerchantParcels($query)
    {
        return $query->where('branch_id', auth()->user()->merchant->id);
    }
    public function branchs()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function scopePickup($query)
    {
        return $query->whereIn('status', ['pickup-pending', 'pickup-rescheduled'])->where('is_return', false);
    }
    public function scopeDeleviry($query)
    {
        return $query->where('status', 'received-to-warehouse')->whereNull('delivery_rider_run_id')->where('is_return', false);
    }




    public function rider_run()
    {
        return $this->belongsTo(RiderRun::class, 'pickup_rider_run_id');
    }


    public  function district()
    {
        return $this->belongsTo(District::class);
    }
    public  function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function pickup_address()
    {
        return $this->belongsTo(PickupAddress::class)->withoutGlobalScope(PickupAddressByMerchant::class);
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function status()
    {
        return $this->belongsTo(ParcelStatus::class,  'status', 'key',);
    }


    // public function riderRun()
    // {
    //     return $this->belongsTo(RiderRun::class);
    // }

    public function pickupriderParcel()
    {
        return $this->belongsTo(RiderParcel::class, ['id', 'pickup_rider_run_id'], ['parcel_id', 'rider_run_id']);
    }
    public function riderParceldelivery()
    {
        return $this->belongsTo(RiderParcel::class, ['id', 'delivery_rider_run_id'], ['parcel_id', 'rider_run_id']);
    }

    public function riderParcelRetrunDelivery()
    {
        return $this->belongsTo(RiderParcel::class, ['id', 'return_delivery_rider_run_id'], ['parcel_id', 'rider_run_id']);
    }

    public function riderParcelRetrunPickup()
    {
        return $this->belongsTo(RiderParcel::class, ['id', 'return_pickup_rider_run_id'], ['parcel_id', 'rider_run_id']);
    }





    public function scopeWithRiderRunPickup($query)
    {
        return $query->get()->map(function ($parcel) {
            $run = RiderRun::find($parcel->pickup_rider_run_id);
            $runx = RiderParcel::where('rider_run_id', $parcel->pickup_rider_run_id)->where('parcel_id', $parcel->id)->first();
            return (object) array_merge($parcel->toArray(), ['rider_run' => $run, 'rider_parcel' => $runx]);
        });
        // $query->where
    }
    public function scopeWithRiderRunDelivery($query)
    {
        return $query->get()->map(function ($parcel) {
            $run = RiderRun::find($parcel->delivery_rider_run_id);
            $runx = RiderParcel::where('rider_run_id', $parcel->delivery_rider_run_id)->where('parcel_id', $parcel->id)->first();
            return (object) array_merge($parcel->toArray(), ['rider_run' => $run, 'rider_parcel' => $runx]);
        });
    }
    public function scopeWithRiderRunReturn($query)
    {
        return $query->get()->map(function ($parcel) {
            $run = RiderRun::find($parcel[return_type($parcel)]);
            $rstatus = ParcelStatus::where('key', $parcel->return_status)->first()->group !== "return-pickup" ? "pickup" : "delivery";
            $runx = RiderParcel::where('rider_run_id', $parcel[return_type($parcel)])->where('parcel_id', $parcel->id)->first();
            return (object) array_merge($parcel->toArray(), ['rider_run' => $run, 'rider_parcel' => $runx, 'r_status' => $rstatus]);
        });
    }
}
