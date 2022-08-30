<?php

namespace App\Models;

use App\Models\Scopes\PickupAddressByMerchant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupAddress extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->merchant_id = auth()->user()->id;
        });
        static::updated(function ($model) {
            $model->merchant_id = auth()->user()->id;
        });
        static::created(function ($model) {
            $model->merchant_id = auth()->user()->id;
        });
        static::deleted(function ($model) {
            $model->merchant_id = auth()->user()->id;
        });


        static::addGlobalScope(new PickupAddressByMerchant);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
