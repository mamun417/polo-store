<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\CategoryHelper;
use App\Http\Requests\CategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all latest Categories
        $categories = Category::latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';

            $categories = $categories->where('description', 'like', $keyword)
                ->orWhere('name', 'like', $keyword);
        }

        $categories = $categories->paginate($perPage);

        //Show All Categories
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        $main_categories = CategoryHelper::getMainCategories();
        return view('admin.pages.categories.create', compact('main_categories'));
    }

    public function store(CategoryRequest $request)
    {
        $request_data = $request->validated();
        $request_data['status'] = !!$request->status;

        DB::beginTransaction();

        try {
            Category::create($request_data);

            DB::commit();

            return redirect()->back()->with('success', 'Category Created Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Category $category)
    {
        $main_categories = CategoryHelper::getMainCategories();

        $main_categories = CategoryHelper::removeCategoryById($main_categories, $category->id);

        return view('admin.pages.categories.edit', compact('main_categories', 'category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $request_data = $request->validated();
        $request_data['status'] = !!$request->status;

        DB::beginTransaction();

        try {
            $category->update($request_data);

            DB::commit();

            return redirect()->back()->with('success', 'Category Updated Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {
            $category->delete();
            DB::commit();

            return redirect()->route('admin.categories.index')->with('success', 'Category Delete Successfully');

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->route('admin.categories.index')->with('error', $exception->getMessage());
        }
    }

    public function changeStatus(Category $category)
    {
        $category->update(['status' => !$category->status]);
        return response()->json(['status' => true]);
    }
}
