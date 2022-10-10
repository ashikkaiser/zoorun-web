<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function ScopeActive($q)
    {
        return $q->where('status', true);
    }
    public function ScopeInactive($q)
    {
        return $q->where('status', false);
    }
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
