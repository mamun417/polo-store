<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all latest brand
        $brands = Brand::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $brands = $brands->where('description', 'like', $keyword)->orWhere('name', 'like', $keyword);
        }

        $brands = $brands->paginate($perPage);

        //Show All Brands
        return view('admin.pages.brands.index', compact('brands'));
    }


    public function create()
    {
        return view('admin.pages.brands.create');
    }


    public function store(BrandRequest $request)
    {
        DB::beginTransaction();

        try {
            Brand::create([
                'name' => $request->name,
                'web_url' => $request->web_url,
                'description' => $request->description,
                'status' => $request->status ? true : false,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Brand Created Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    public function show(Brand $brand)
    {
        return view('admin.pages.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.pages.brands.edit', compact('brand'));
    }


    public function update(BrandRequest $request, Brand $brand)
    {
        DB::beginTransaction();

        try {
            $brand->update([
                'name' => $request->name,
                'web_url' => $request->web_url,
                'description' => $request->description,
                'status' => $request->status ? true : false,
            ]);

            DB::commit();

            return redirect()->route('admin.brands.index')->with('success', 'Brand Updated Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Brand $brand)
    {
        DB::beginTransaction();

        try {

            $brand->delete(); // need check

            DB::commit();

            return redirect()->route('admin.brands.index')->with('success', 'Brand Deleted Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.brands.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(Brand $brand)
    {
        $brand->update(['status' => !$brand->status]);
        return response()->json(['status' => true]);
    }
}
