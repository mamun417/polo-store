<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\ProductHelper;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Slider;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $sliders = Slider::status()->with('image')->latest()->get();

//        2021-01-20 08:39:52
        $feature_products = Product::feature()->with(['offers' => function ($query) {
            $query->whereDate('start_at', '<=', now())
                ->whereDate('expire_at', '>=', now())
                ->where('status', 1);
        }])->latest();


        $feature_products = ProductHelper::search($feature_products);
        $feature_products = $feature_products->paginate(21);

        // get all offer id that user already used
        if (Auth::check()) {
            $already_applied_offer_ids = Auth::user()->orderDetails()->pluck('offer_id')->unique()->values()->filter(function ($offer) {
                return $offer != null;
            })->toArray();

            // if user save the order for later
            $user_already_saved_offer_ids = Auth::user()->offers()->pluck('offer_id')->unique()->values()->toArray(); // get from offer_user table
            // get all unique offer id
            $already_applied_offer_ids = array_unique(array_merge($already_applied_offer_ids, $user_already_saved_offer_ids));

        } else {
            $already_applied_offer_ids = [];
        }


        if (Session::has('product_id')) {
            $session_decline_product = Session::get('product_id');
        } else {
            $session_decline_product = [];
        }
        return view('home', compact('feature_products', 'sliders', 'session_decline_product', 'already_applied_offer_ids'));
    }
}
