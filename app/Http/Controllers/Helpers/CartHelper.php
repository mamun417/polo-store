<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartHelper extends Controller
{
    /**
     * Check product exiting with product_id/rowId
     * @param $instance
     * @param $id
     * @param string $chek_with
     * @return bool
     */
    public static function checkCartExitProduct($instance, $id, $chek_with = 'id'): bool
    {
        $products = Cart::instance($instance)->search(function ($cartItem) use ($id, $chek_with) {
            return $cartItem->$chek_with === $id;
        });

        return !!count($products);
    }

    public static function searchProduct($instance, $id, $chek_with = 'id')
    {
        return Cart::instance($instance)->search(function ($cartItem) use ($id, $chek_with) {
            return $cartItem->$chek_with === $id;
        })->first();
    }


    public static function checkProductStock($product_id, $qty, $size = null)
    {
        $product = Product::active()->find($product_id);

        if (!$product) {
            return false;
        }

        $product_stock = !$product->price && $size
            ? $product->productPricesWithSize()->where('size', $size)->first()->stock
            : $product->stock;

        return $product_stock <= $qty ? $product_stock : (int) $qty;
    }
}
