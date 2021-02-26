<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'product_id',
        'offer_id',
        'offer_amount',
        'product_size',
        'product_color',
        'product_price',
        'product_quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
