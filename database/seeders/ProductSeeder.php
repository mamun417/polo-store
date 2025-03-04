<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        Product::factory()->times(100)
            ->has(ProductPrice::factory()->count(3), 'productPricesWithSize')
            ->create()
            ->each(function (Product $product) use ($faker) {
                print_r($product->toArray());
                if ($product->price){
                    $product->productPricesWithSize()->delete();
                }
                // Start => image upload section
                for ($x = 0; $x <= 3; $x++) {
                    $image_path = $faker->imageUrl(Product::PRODUCT_WIDTH, Product::PRODUCT_HEIGHT);

                    $image_path = str_replace("via.placeholder", "dummyimage", $image_path);

                    $product->images()->create([ // save an image
                        'url' => $image_path,
                        'type' => 'lg',
                    ]);
                }
                // End => image upload section

                // Start => comments section
                $comments = Comment::factory()->count(random_int(3, 10))->make();
                $product->comments()->saveMany($comments);
                // End => comments section
            });
    }
}
