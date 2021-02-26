<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductRating;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::latest()->limit(10)->get()->pluck('id');
        $users = User::latest()->limit(10)->get()->pluck('id');
        for ($i = 0; $i < 3; $i++){
            foreach ($products as $key => $product){
                ProductRating::create([
                    'product_id' => $products[$key],
                    'user_id' => $users[$key],
                    'rating' => random_int(1, 5),
                ]);
            }
        }
    }
}
