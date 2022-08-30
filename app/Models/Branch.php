<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['name', "short_name", "show_short_name", 'address', 'district_id', 'zone_ids',  "email", "phone", "image_url", 'status'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    // public function zone()
    // {
    //     return $this->belongsTo(Zone::class);
    // }
    // public function ScopeZone($query)
    // {
    //     $zone_ids = $query->zone_ids;
    //     $zones = Zone::whereIn('id', $zone_ids)->get();
    //     return $query->addsSelect(['zones' => $zones]);
    // }
}
