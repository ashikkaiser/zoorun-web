<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'district_id', 'status', 'color'];

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
}
