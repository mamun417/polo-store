<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRatingRequest;
use App\Models\ProductRating;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRatingRequest $request)
    {
        $request_data = $request->validated();
        DB::beginTransaction();

        try {
            $checkProductOrdered = Auth::user()->orderDetails()
                ->where('product_id', $request->product_id)->first();


            if($checkProductOrdered){
                if($checkProductOrdered && $checkProductOrdered->order->payment_status){
                    ProductRating::create($request_data);
                }else{
                    return back()->with('error', 'You need purchase this product');
                }
            }else{
                return back()->with('error', 'You need purchase this product');
            }

            DB::commit();

            return redirect()->back()->with('success', 'Rating Submitted Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRating $productRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRating $productRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRating $productRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRating $productRating)
    {
        //
    }
}
