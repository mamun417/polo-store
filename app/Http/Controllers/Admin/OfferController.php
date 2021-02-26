<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Product;
use DB;

class OfferController extends Controller
{
    public function index()
    {
        $perPage = request('perPage') ?: 10;
        $keyword = request('keyword');

        $offers = Offer::latest();

        if (request('offer_id')) {
            $offers = $offers->where('id', request('offer_id'));
        }

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $offers = $offers->where('title','like', $keyword)
                ->orWhere('amount', 'like', $keyword)
                ->orWhereHas('product', function ($product) use ($keyword) {
                    return $product->where('name', 'like', $keyword);
                });
        }

        $offers = $offers->paginate($perPage);

        return view('admin.pages.offers.index', compact('offers'));
    }

    public function create()
    {
        $product = Product::find(request('product_id'));
        return view('admin.pages.offers.create', compact('product'));
    }

    public function store(OfferRequest $request): \Illuminate\Http\RedirectResponse
    {
        // check already exit offer
        $product = Product::find($request->product_id);

        if (isset($product->offer)) {
            return redirect()->back()->with('error', 'Already exit offer for this product');
        }

        DB::beginTransaction();

        try {
            $request_data = $request->validated();
            $request_data['status'] = !!$request->status;

            Offer::create($request_data);

            DB::commit();

            return redirect()->back()->with('success', 'Offer Created Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    public function edit(Offer $offer)
    {
        return view('admin.pages.offers.edit', compact('offer'));
    }

    public function update(offerRequest $request, Offer $offer): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {
            $request_data = $request->validated();
            $request_data['status'] = !!$request->status;

            $offer->update($request_data);

            DB::commit();

            return back()->with('success', 'Offer Updated Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Offer $offer): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        try {

            $offer->delete(); // need check

            // data remove from offer_user table
            $users = $offer->users->pluck('id')->toArray();

            $offer->users()->detach($users);

            DB::commit();

            return redirect()->route('admin.offers.index')->with('success', 'Offer Deleted Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.offers.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(Offer $offer): \Illuminate\Http\JsonResponse
    {
        $offer->update(['status' => !$offer->status]);
        return response()->json(['status' => true]);
    }
}
