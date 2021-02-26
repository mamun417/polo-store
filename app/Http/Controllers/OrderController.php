<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CartHelper;
use App\Http\Controllers\Helpers\ShippingMethodHelper;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingMethod;
use Auth;
use Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderSubmit(Request $request)
    {

        $cart = Cart::instance('cart');

        // check product status active and stock (size wise)
        foreach ($cart->content() as $cart_product) {

            $check_active_product = Product::find($cart_product->id);

            $p_size = $check_active_product->price ? null : $check_active_product->productPricesWithSize()
                ->where('size', $cart_product->options['size'])
                ->first()->size;

            $valid_stock = CartHelper::checkProductStock($check_active_product->id, $cart_product->qty, $p_size);

            if (!$valid_stock) {
                Cart::instance('cart')->remove($cart_product->rowId);
            } else {
                Cart::instance('cart')->update($cart_product->rowId, $valid_stock); // Will be update the quantity
            }
        }

        if ($cart->count() == 0) { // check cart count == 0 then back to home page with error message '' then cart empty
            Cart::instance('cart')->destroy();
            return redirect()->route('home')->with('error', 'Your order is failed');
        }


        $shipping_methods = ShippingMethodHelper::getApplicableShippingMethods(); // get applicable shipping methods
        $shipping_method_ids = $shipping_methods->pluck('id')->toArray();

        if (count($shipping_method_ids)) {
            $request->validate([
                'shipping_method' => 'required|in:' . implode(',', $shipping_method_ids)
            ]);
        }

        $shipping_method = '';

        if (count($shipping_method_ids)) {
            $shipping_method = ShippingMethod::find($request->shipping_method);
        }

        $shipping_charge = @$shipping_method->charge ? @$shipping_method->charge : 0;
        $shipping_charge = (float)$shipping_charge;


        // data store in order table
        $order = Order::create([
            'user_id' => auth()->id(),
            'shipping_method_id' => @$shipping_method->id,
            'shipping_charge' => $shipping_charge,
            'tax' => $cart->taxFloat(),
            'sub_total' => $cart->subtotalFloat(),
            'grand_total' => $cart->totalFloat() + $shipping_charge,
            'payment_status' => 0, // payment status array declare in Order model
            'order_status' => 0, // order status array declare in Order model
        ]);

        $order_details = [];
        $offer_id_arr = [];

        foreach ($cart->content() as $cart_product) {
            $order_details[] = [
                'product_id' => $cart_product->id,
                'offer_id' => $cart_product->options['offer_id'],
                'offer_amount' => $cart_product->options['offer_amount'],
                'product_size' => $cart_product->options['size'],
                'product_color' => $cart_product->options['color'],
                'product_price' => $cart_product->price,
                'product_quantity' => $cart_product->qty
            ];

            if ($cart_product->options['offer_id']) { // collect all offer id from a cart item
                array_push($offer_id_arr, $cart_product->options['offer_id']);
            }
        }

        // create a order details
        $order->orderDetails()->createMany($order_details);

        // delete cart
        Cart::instance('cart')->destroy();

        // delete if offer is exist on this order
        if (count($offer_id_arr)) {
            Auth::user()->offers()->detach($offer_id_arr);
        }

        // now we need to send email to auth user email

        return redirect()->route('payment.page', $order->id)->with('success', 'Your order successfully submitted');
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('', compact('orders'));
    }

    public function paymentPage(Order $order)
    {
        if (Auth::id() !== $order->user_id) {
            abort(404);
        }

        return view('pages.payment.payment', compact('order'));
    }

    public function orderCancel(Order $order)
    {
        if ($order->order_status === 3) { // 3 = complete
            return back()->with('error', 'Your order already has been completed');
        }

        $order->update(['order_status' => 4]);

        return back()->with('success', 'Order cancel successful');
    }
}
