<?php

namespace App\Http\Controllers;

use App\Models\Product;

class OfferController extends Controller
{

    public function getOfferProduct(Product $product)
    {
        $offer = $product->offers()->first();
        if ($offer && $offer->status) {
            // product image
            // offer percentage image

            if ($offer->type == 1) { // 1 = percentage
                $offer_per = $offer->amount;
            } else {
                $offer_per = $offer->amount / 100; // get percentage
            }
            $data = [
                'image' => $product->images()->first()->url,
                'offer_percentage' => $offer_per,
            ];
            return $data;
        } else {
            return response()->json('', 404);
        }
    }
}
