<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string)
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shipping_method_id',
        'coupon_id',
        'payment_method',
        'shipping_charge',
        'tax',
        'sub_total',
        'grand_total',
        'payment_status',
        'order_status',
    ];


    const ORDER_STATUS = [
        0 => 'pending',
        1 => 'processing',
        2 => 'delivery',
        3 => 'complete',
        4 => 'cancel',
    ];

    const ORDER_STATUS_COLOR = [
        0 => 'warning',
        1 => 'info',
        2 => 'info',
        3 => 'primary',
        4 => 'danger',
    ];

    const PAYMENT_STATUS = [
        0 => 'unpaid',
        1 => 'paid',
    ];


    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
