<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\ProductHelper;
use App\Mail\UserOfferSaveForLater;
use App\Models\Offer;
use App\Models\Product;
use App\Notifications\OfferSavedLater;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Mail;

class UserOfferController extends Controller
{
    public function index()
    {
        $perPage = request('perPage') ?: 10;

        $offers = Auth::user()->offers()->where('status', '=', 1)->latest();;
        $offers = $offers->paginate($perPage);

        return view('pages.profile.offers', compact('offers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'offer_id' => 'required',
            'product_id' => 'required',
        ]);

//        // only authenticated user can action this
//        if (!Auth::check()) {
//            return redirect()->back()->with('warning', 'Please first login');
//        }

        DB::beginTransaction();
        try {

            $product = Product::find($request->product_id);
            $offer = Offer::active()->find($request->offer_id);

            if (!$offer && !ProductHelper::offerBelongsToProduct($offer, $product)) {
                return redirect()->back()->with('warning', 'Your offer is not valid');
            }

            if (ProductHelper::offerExpired($offer)) {
                return redirect()->back()->with('warning', 'Your offer is expired. please try another one.');
            }

//            if (ProductHelper::offerAppliedBelongsToProduct($offer, $product)) {  // true means auth user already applied this offer under this product
//                return redirect()->back()->with('warning', 'You are not eligible for this offer');
//            }

//            // store this offer
//            Auth::user()->offers()->syncWithoutDetaching($request->offer_id); // if exist not delete // if not exist store new

            // send email
//            Mail::to($request->email)->send(new UserOfferSaveForLater());

            Notification::route('mail', $request->email)
                ->notify(new OfferSavedLater($offer));


            DB::commit();
            return redirect()->back()->with('success', 'Offer Saved Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function offerDecline(Product $product)
    {
        $offer = $product->offers()->first();
        if ($offer && $offer->status) {

            if (Session::has('product_id')) {
                Session::push('product_id', $product->id);
            } else {
                Session::put('product_id', [$product->id]);
            }

            return redirect()->back()->with('success', 'Offer Decline Successfully');
        } else {
            return redirect()->back()->with('error', 'Offer is not available');
        }
    }


    public function offerDelete(Offer $offer)
    {
        Auth::user()->offers()->detach($offer->id);
        return redirect()->back()->with('success', 'Your offer deleted success');
    }

}
