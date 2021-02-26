<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'slug',
        'apply_type',
        'value',
        'usable_quantity',
        'count',
        'started_at',
        'expired_at',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

}
