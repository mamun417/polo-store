<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Helpers\ProductHelper;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        $status = Order::ORDER_STATUS[0]; // pending

        $check_status = in_array(request('status'), Order::ORDER_STATUS);

        if ($check_status) {
            $status = array_search(request('status'), Order::ORDER_STATUS);
        }

        $perPage = request('perPage') ?: 10;
        $keyword = request('keyword');

        //get all latest order
        $orders = Order::with('user', 'shippingMethod', 'orderDetails')->where('order_status', $status)->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $orders = $orders->where('grand_total', 'like', $keyword)
                ->orWhere('sub_total', 'like', $keyword)
                ->orWhere('payment_method', 'like', $keyword)
                ->orWhere('tax', 'like', $keyword)
                ->orWhere('shipping_charge', 'like', $keyword)
                ->orWhere('payment_status', 'like', $keyword)
                ->orWhere('order_status', 'like', $keyword)
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                });
        }

        $orders = $orders->paginate($perPage);

        return view('admin.pages.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        return view('admin.pages.orders.details', compact('order'));
    }


    public function ChangeStatus(Request $request, Order $order)
    {
        $keys = implode(',', array_keys(Order::ORDER_STATUS));

        $request->validate([
            'status' => 'required|in:' . $keys
        ]);

        $status = (int)$request->status;

        if ($status === 3) { // 2 = complete
            foreach ($order->orderDetails as $detail) {
                $product = Product::find($detail->product_id);
                ProductHelper::productQuantityMinus($product->id, $detail->product_quantity, $detail->product_size);
            }
        } elseif ($order->order_status === 3 && $status === 4) {
            foreach ($order->orderDetails as $detail) {
                $product = Product::find($detail->product_id);
                ProductHelper::productQuantityBack($product->id, $detail->product_quantity, $detail->product_size);
            }
        }

        $order->update([
            'order_status' => $status
        ]);

        return redirect()->back()->with('success', 'Order Status Successfully Changed');
    }


    public function changePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|integer'
        ]);
        $order->payment_status = $request->payment_status;
        $order->save();
        return redirect()->back()->with('success', 'Order Payment Status Successfully Changed');
    }


}

