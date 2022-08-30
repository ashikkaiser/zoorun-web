<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceWeightPackageSetting extends Model
{
    use HasFactory;


    public function serviceArea()
    {
        return $this->belongsTo(ServiceArea::class);
    }

    public function weightPackage()
    {
        return $this->belongsTo(WeightPackage::class);
    }
}
