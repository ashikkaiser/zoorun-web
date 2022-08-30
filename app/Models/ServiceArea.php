<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "unit_id",
        "description",
        "cod"
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function weightPackages()
    {
        return $this->hasMany(ServiceWeightPackageSetting::class);
    }
}
