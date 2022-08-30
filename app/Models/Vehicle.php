<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "sl_no",
        "number",
        "driver_name",
        "driver_contact",
        "road",
        "status",
    ];
}
