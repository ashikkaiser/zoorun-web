<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
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
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
