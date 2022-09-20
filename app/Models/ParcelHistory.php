<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelHistory extends Model
{
    use HasFactory;
    public function message()
    {
        return $this->belongsTo(ParcelStatus::class, 'status_id', 'id');
    }
}
