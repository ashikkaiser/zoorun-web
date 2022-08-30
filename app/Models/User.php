<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        "user_type",
        "address",
        "phone",
        "image_url",
        "branch_id",
        "warehouse_id",
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function rider()
    {
        return $this->belongsTo(Rider::class, 'id', 'user_id');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'id', 'user_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function ScopeWarehouseUser($query)
    {
        return $query->where('user_type', 'warehouse');
    }
    public function ScopeBranchUser($query)
    {
        return $query->where('user_type', 'branch');
    }
    public function ScopeActive($query)
    {
        return $query->where('status', true);
    }
    public function ScopeTrash($query)
    {
        return $query->where('status', false);
    }
}
