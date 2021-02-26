<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use DB;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        $taxes = Tax::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $taxes = $taxes->where('name', 'like', $keyword)
                ->orWhere('tax', 'like', $keyword)
                ->orWhere('type', 'like', $keyword)
            ;
        }

        $taxes = $taxes->paginate($perPage);

        return view('admin.pages.settings.taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('admin.pages.settings.taxes.create');
    }

    public function store(Request $request)
    {
        $request_data = $request->validate([
            'name' => 'required|string|unique:taxes,name',
            'tax' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        $request_data['status'] = !!$request->status;

        DB::beginTransaction();

        try {
            Tax::create($request_data);

            DB::commit();

            return redirect()->back()->with('success', 'Tax Created Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Tax $tax)
    {

        return view('admin.pages.settings.taxes.edit', compact('tax'));
    }

    public function update(Request $request, Tax $tax)
    {
        $request_data = $request->validate([
            'name' => 'required|string|unique:taxes,name,' . $tax->id,
            'tax' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        $request_data['status'] = !!$request->status;

        DB::beginTransaction();

        try {
            $tax->update($request_data);

            DB::commit();

            return redirect()->back()->with('success', 'Tax Updated Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Tax $tax)
    {
        DB::beginTransaction();

        try {
            $tax->delete();
            DB::commit();

            return redirect()->route('admin.taxes.index')->with('success', 'Tax Delete Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.taxes.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(Tax $tax)
    {
        $tax->update(['status' => !$tax->status]);
        return response()->json(['status' => true]);
    }
}
