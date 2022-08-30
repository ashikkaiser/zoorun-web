<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    public function scopeBranchRider($query)
    {
        return $query->where('branch_id', auth()->user()->branch_id);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
