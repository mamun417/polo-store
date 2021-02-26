<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Tax;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all latest products
        $products = Product::with('category', 'brand')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $products = $products->where('name', 'like', $keyword)
                ->orWhere('price', 'like', $keyword)
                ->orWhere('code', 'like', $keyword)
                ->orWhereHas('brand', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                })
                ->orWhereHas('category', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword);
                });
        }

        $products = $products->paginate($perPage);

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $taxes = Tax::active()->latest()->get();
        return view('admin.pages.products.create', compact('categories', 'brands', 'taxes'));
    }


    public function store(ProductRequest $request)
    {
//        dd($request->all());
        DB::beginTransaction();

        try {
            $product_color_arr = array_filter($request->product_color_arr, function ($color) {
                return $color !== null;
            });
            if ($product_color_arr) {
                $product_color_arr = json_encode($product_color_arr);
            } else {
                $product_color_arr = null;
            }

            $product = Product::create([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'tax_id' => $request->tax,
                'name' => $request->product_name,
                'price' => $request->product_price,
                'discount_price' => $request->product_price ? $request->product_discount_price : null,
                'stock' => $request->product_price ? $request->product_quantity : null,
                'code' => $request->product_code,
                'color' => $product_color_arr,
                'details' => $request->product_details,
                'status' => $request->status ? true : false,
                'feature' => $request->feature ? true : false,
                'on_sale' => $request->on_sale ? true : false,
            ]);


            if (!$request->product_price) {
                // store price with size and stock
                foreach ($request->product_size_arr as $key => $size) {
                    $product->productPricesWithSize()->create([
                        'size' => $size,
                        'price' => $request->product_price_arr[$key],
                        'discount_price' => $request->discount_price_arr[$key],
                        'stock' => $request->product_stock_arr[$key],
                    ]);
                }
            }

            // need to upload product photo
            foreach ($request->file('product_img') as $image) {

                $image_path = FileHandler::upload($image, 'products', ['width' => Product::PRODUCT_WIDTH, 'height' => Product::PRODUCT_HEIGHT]);

                $product->images()->create([ // save an image
                    'url' => Storage::url($image_path),
                    'base_path' => $image_path,
                    'type' => 'lg',
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Product Created Successfully');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function show(Product $product)
    {
        return view('admin.pages.products.details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View|Response
     */
    public function edit(Product $product)
    {
//        dd($product->toArray());

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $taxes = Tax::active()->latest()->get();

        return view('admin.pages.products.edit', compact('categories', 'brands', 'product', 'taxes'));
    }


    public function update(ProductRequest $request, Product $product)
    {
//        dd($request->all());
        DB::beginTransaction();

        try {
            $product_color_arr = array_filter($request->product_color_arr, function ($color) {
                return $color !== null;
            });
            if ($product_color_arr) {
                $product_color_arr = json_encode($product_color_arr);
            } else {
                $product_color_arr = null;
            }

            $product->update([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'tax_id' => $request->tax,
                'name' => $request->product_name,
                'price' => $request->product_price,
                'discount_price' => $request->product_price ? $request->product_discount_price : null,
                'stock' => $request->product_price ? $request->product_quantity : null,
                'code' => $request->product_code,
                'color' => $product_color_arr,
                'details' => $request->product_details,
                'status' => $request->status ? true : false,
                'feature' => $request->feature ? true : false,
                'on_sale' => $request->on_sale ? true : false,
            ]);

            if (!$request->product_price) { // if not present product price
                // first need to delete old  product size and create a new one
                $product->productPricesWithSize()->delete();
                // create a new
                foreach ($request->product_size_arr as $key => $size) {
                    $product->productPricesWithSize()->create([
                        'size' => $size,
                        'price' => $request->product_price_arr[$key],
                        'discount_price' => $request->discount_price_arr[$key],
                        'stock' => $request->product_stock_arr[$key],
                    ]);
                }
            }else{ // if present delete old all
                $product->productPricesWithSize()->delete();
            }

            if ($request->file('product_img')) {
                // need to upload product photo
                foreach ($request->file('product_img') as $image) {

                    $image_path = FileHandler::upload($image, 'products', ['width' => Product::PRODUCT_WIDTH, 'height' => Product::PRODUCT_HEIGHT]);
                    $product->images()->create([ // save an image
                        'url' => Storage::url($image_path),
                        'base_path' => $image_path,
                        'type' => 'lg',
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Product Created Successfully');
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Product $product)
    {
        // delete all image
        foreach ($product->images as $key => $image) {
            FileHandler::delete($image->base_path);
        }
        $product->images()->delete();

        $product->delete();

        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }


    public function changeStatus(Product $product)
    {
        $product->update(['status' => !$product->status]);
        return response()->json(['status' => true]);
    }

    public function sizeRemove(Request $request)
    {
        if ($request->ajax()) {
            $product_size_id = $request->product_size_id;
            $size = ProductPrice::findOrFail($product_size_id);
            $size->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product size with price Successfully deleted'
            ]);

        } else {
            abort(404);
        }
    }


    public function removeProductImage(Request $request)
    {
        if ($request->ajax()) {
            $image_id = $request->image_id;
            $image = Image::findOrFail($image_id);

            // delete root image
            FileHandler::delete($image->base_path);

            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product Image Successfully deleted'
            ]);

        } else {
            abort(404);
        }
    }
}
