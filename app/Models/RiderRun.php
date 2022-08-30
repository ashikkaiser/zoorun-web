<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class RiderRun extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $last_id = RiderRun::latest('id')->first();
            $run_id = isset($last_id) ? $last_id->id + 1000  : 1000;
            if (!$model->run_id) {
                $model->run_id =  'RUN-' . $run_id;
            }
        });

        // static::created(function ($model) {
        //     // if (request()->has('rider_id')) {
        //     //     $model->rider()->associate(request()->rider_id);
        //     //     $model->save();
        //     // }
        //     // Log::alert('RiderRun created: ' . $model);

        //     // $rider = new RiderParcel();
        //     // $rider->rider_run_id = $model->id;
        //     // $rider->type = $model->run_type;
        //     // $rider->parcel_id = 1;
        //     // $rider->save();
        // });
    }


    protected $dates = ['create_date_time', 'complete_date_time'];


    protected $fillable = [
        'run_id', 'run_type', 'create_date_time', 'complete_date_time', 'rider_id', 'status', 'parcel_id'
    ];

    function rider_parcel()
    {
        return $this->hasMany(RiderParcel::class);
    }
    public function scopeBranch($query)
    {
        return $query->where('branch_id', auth()->user()->branch_id);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
    // public function scopePickup($query)
    // {
    //     return $query->where('status', 'pickup-pending')->whereNull('pickup_rider_id');
    // }


}
