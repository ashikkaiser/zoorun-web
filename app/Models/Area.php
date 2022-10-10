<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'district_id', 'zone_id', 'postal_code', 'status', 'service_area_ids'];

    public function ScopeActive($q)
    {
        return $q->where('status', true);
    }
    public function ScopeInactive($q)
    {
        return $q->where('status', false);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
