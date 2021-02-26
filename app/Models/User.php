<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static latest()
 * @method static findOrFail(int|string|null $user_id)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderDetails()
    {
        return $this->hasManyThrough(OrderDetail::class, Order::class);
    }


    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function offers(){
        return $this->belongsToMany(Offer::class);
    }

}
