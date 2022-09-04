<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RiderParcel extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    public function scopeWithRiderRun($query)
    {
        return $query->with('riderRun');
    }

    public function riderRun()
    {
        return $this->belongsTo(RiderRun::class)->where('id', $this->rider_run_id);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class, 'parcel_id');
    }
}
