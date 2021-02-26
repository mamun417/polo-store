<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class ProductRating extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'rating'];

    public function product():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        $this->belongsTo(Product::class);
    }
}
