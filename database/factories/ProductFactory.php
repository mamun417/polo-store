<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word;
        $feature = $this->faker->numberBetween(0, 1);
        $price = $this->faker->numberBetween(0, 500);
        return [
            'category_id' => function () {
                if (Category::count() > 0) {
                    return $this->faker->randomElement(Category::pluck('id')->toArray());
                } else {
                    return Category::factory()->create()->id;
                }
            },
            'brand_id' => function () {
                if (Brand::count() > 0) {
                    return $this->faker->randomElement(Brand::pluck('id')->toArray());
                } else {
                    return Brand::factory()->create()->id;
                }
            },
            'tax_id' => function () {
                if (Tax::count() > 0) {
                    return $this->faker->randomElement(Tax::pluck('id')->toArray());
                } else {
                    return Tax::factory()->create()->id;
                }
            },
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $price ?? null,
            'discount_price' => $price ? random_int(10, 100) : null,
            'stock' => $price ? random_int(10, 20) : null,
            'code' => $this->faker->ean8,
            'color' => function () {
                $color = [];
                for ($i = 0; $i <= 3; $i++) {
                    array_push($color, $this->faker->colorName);
                }
                return json_encode($color);
            },
            'details' => $this->faker->text(400),
            'weight' => $this->faker->randomDigit,
            'feature' => $feature,
            'on_sale' => $feature,
            'status' => $this->faker->numberBetween(0, 1),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
