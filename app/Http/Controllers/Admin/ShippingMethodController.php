<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingMethodRequest;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ShippingMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all brand
        $shippingMethods = ShippingMethod::with('createdUser', 'updatedUser')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $shippingMethods = $shippingMethods->where('title', 'like', $keyword)
                ->orWhere('fee_or_free', 'like', $keyword)
                ->orWhere('needed_fee', 'like', $keyword)
            ;
        }

        $shippingMethods = $shippingMethods->paginate($perPage);
        return view('admin.pages.shipping-methods.index', compact('shippingMethods'));
    }

    public function create()
    {
        return view('admin.pages.shipping-methods.create');
    }

    public function store(ShippingMethodRequest $request)
    {
        DB::beginTransaction();

        try {
            ShippingMethod::create([
                'title' => $request->title,
                'applicable_amount' => $request->applicable_amount,
                'charge' => $request->charge,
                'status' => $request->status ? true : false,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Shipping Method Created Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function show(ShippingMethod $shippingMethod)
    {
        //
    }

    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.pages.shipping-methods.edit', compact('shippingMethod'));
    }

    public function update(ShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        DB::beginTransaction();

        try {
            $shippingMethod->update([
                'title' => $request->title,
                'applicable_amount' => $request->applicable_amount,
                'charge' => $request->charge,
                'status' => $request->status ? true : false,
            ]);

            DB::commit();

            return redirect()->route('admin.shipping-methods.index')->with('success', 'Shipping Method Updated Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(ShippingMethod $shippingMethod)
    {
        DB::beginTransaction();

        try {

            $shippingMethod->delete();

            DB::commit();

            return redirect()->route('admin.shipping-methods.index')->with('success', 'Shipping Method Deleted Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.shipping-methods.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(ShippingMethod $shippingMethod)
    {
        $shippingMethod->update(['status' => !$shippingMethod->status]);
        return response()->json(['status' => true]);
    }
}
