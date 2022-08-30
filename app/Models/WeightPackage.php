<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "unit_id",
        "title",
        "description",
        "rate",
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
