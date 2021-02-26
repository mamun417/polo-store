<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index()
    {
        $perPage = request('perPage') ?: 5;

        $orders = Order::with( 'orderDetails', 'orderDetails.product')->where('user_id', Auth::id())->latest();
        $orders = $orders->paginate($perPage);

        $user = User::findOrFail(Auth::id());

        return view('pages.profile.orders', compact('user', 'orders'));
    }
}
