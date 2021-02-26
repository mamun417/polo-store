<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CartHelper;
use App\Http\Controllers\Helpers\ProductHelper;
use App\Http\Controllers\Helpers\ShippingMethodHelper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ShippingMethod;
use Auth;
use Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails(Product $product)
    {


        // Start => offer section logic
        $offer_id = request('offerId');
        if ($offer_id) {
            $offer = Offer::find($offer_id);
            if (Auth::check()) {
                if ($offer && ProductHelper::offerBelongsToProduct($offer, $product)) {
                    if (ProductHelper::offerExpired($offer)) {
                        return redirect()->route('products.details', $product->slug)->with('warning', 'Your offer is expired. please try another one.');
                    }
                    if (ProductHelper::offerAppliedBelongsToProduct($offer, $product)) {
                        return redirect()->route('products.details', $product->slug)->with('warning', 'You are not eligible for this offer');
                    }
                } else {
                    return redirect()->route('products.details', $product->slug)->with('warning', 'Your offer is not valid');
                }
                Auth::user()->offers()->syncWithoutDetaching($offer_id); // if exist not delete // if not exist store new
            }
        }
        // End => offer section logic

        $related_product = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(3)->get();

        $product_images = $product->images()->get()->groupBy('type');
        $product_rating = round($product->ratings()->avg('rating'), 2);

        // check exist in cart
        $cart_product = '';
        if (request('cart')) { // cart == rowId
            $cart_product = CartHelper::searchProduct('cart', request('cart'), 'rowId');
        }

        return view('pages.products.show', compact('product', 'related_product', 'product_images', 'cart_product', 'product_rating'));
    }

    public function byCategory(Category $category)
    {
        $sortBy = request('sortBy', 'name');

        $products = $category->products()->active();
        $products = ProductHelper::search($products);
        $products = $products->orderBy($sortBy)->paginate(21);

        return view('pages.products.index', compact('products'));
    }

    public function byBrand(Brand $brand)
    {
        $sortBy = request('sortBy', 'name');

        $products = $brand->products()->active();
        $products = ProductHelper::search($products);
        $products = $products->orderBy($sortBy)->paginate(21);

        return view('pages.products.index', compact('products'));
    }

    public function sizeWisePrice(Request $request)
    {
        $product = ProductPrice::where([
            'product_id' => $request->product_id,
            'size' => $request->size,
        ])->first();
        return $product;
    }

}
