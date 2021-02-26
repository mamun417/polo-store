<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class ProductHelper extends Controller
{
    public static function taxInPercentage($product_price, $tax)
    {
        return ($tax / $product_price) * 100;
    }

    public static function productQuantityMinus($product_id, $qty, $size = null)
    {
        $product = Product::find($product_id);
        if ($product->price) {
            $product->decrement('stock', $qty);
        } elseif (!$product->price && $size) {
            $product->productPricesWithSize()->where('size', $size)->first()->decrement('stock', $qty);
        }
    }

    public static function productQuantityBack($product_id, $qty, $size = null)
    {
        $product = Product::find($product_id);
        if ($product->price) {
            $product->increment('stock', $qty);
        } elseif (!$product->price && $size) {
            $product->productPricesWithSize()->where('size', $size)->first()->increment('stock', $qty);
        }
    }

    public static function productExistQty($product_id, $size = null)
    {
        $product = Product::find($product_id);
        return !$product->price && $size ? $product->productPricesWithSize()->where('size', $size)->first()->stock : $product->stock;
    }

    public static function search($products)
    {
        $keyword = request('keyword');

        if ($keyword) {
            $keyword = '%' . $keyword . '%';

            $products = $products->where('name', 'like', $keyword)
                ->orWhere('price', 'like', $keyword)
                ->orWhere('discount_price', 'like', $keyword)
                ->orWhereHas('productPricesWithSize', function ($query) use ($keyword) {
                    $query->where('price', 'like', $keyword);
                });
        }

        return $products;
    }

    public static function offerBelongsToProduct($offer, $product): bool
    {
        return $offer->status && $offer->product_id == $product->id;
    }

    public static function offerAppliedBelongsToProduct($offer, $product): bool
    {
        if (Auth::check()) {
            $exist = Auth::user()->orderDetails()->where(['product_id' => $product->id, 'offer_id' => $offer->id])->first();
            return isset($exist); // true means already applied
        } else {
            return true;
        }
    }

    public static function offerExpired($offer): bool
    {
        return $offer->expire_at < now(); // true means expired
    }
}
