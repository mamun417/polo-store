<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        $size = $product->productPricesWithSize()->inRandomOrder()->first();
        return [
            'product_id' => $product->id,
            'product_size' => $product->price ? null : $size->size,
            'product_color' => json_decode($product->color)[random_int(0, 2)],
            'product_price' => $product->price ??  $size->price,
            'product_quantity' => $product->price ? $product->stock :  $size->stock,
        ];
    }
}
