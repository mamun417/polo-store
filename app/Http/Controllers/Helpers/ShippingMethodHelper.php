<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Cart;
use Illuminate\Http\Request;

class ShippingMethodHelper extends Controller
{
    public static function getApplicableShippingMethods()
    {
        $shipping_methods = ShippingMethod::active()->latest()->get();

        $cart_total = Cart::instance('cart')->totalFloat();

        $shipping_methods = collect($shipping_methods)->filter(function ($method) use ($cart_total) {
            return $cart_total >= $method->applicable_amount;
        });

        return $shipping_methods;
    }
}
