<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "item_category_id",
        "unit_id",
        "od_rate",
        "hd_rate",
        "transit_od",
        "transit_hd",
        "status",
    ];

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
