<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomer = User::count();

        $totalProduct = Product::count();

        $totalOrder = Order::count();

        $totalSale = Order::sum('grand_total');
        $orders = Order::latest()->paginate(10);
        $today_sale = Order::whereDate('created_at', date('Y-m-d'))->sum('grand_total');

        return view('admin.dashboard', compact(
            'totalCustomer',
            'totalProduct',
            'totalOrder',
            'totalSale',
            'orders',
            'today_sale',
        ));
    }

}
