<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentParcel extends Model
{
    use HasFactory;

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }
}
