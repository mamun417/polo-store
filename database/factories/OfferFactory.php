<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'product_id' => function () {
                if (Product::count() > 0) {
                    return $this->faker->randomElement(Product::pluck('id')->toArray());
                } else {
                    return Product::factory()->create()->id;
                }
            },

            'title' => $this->faker->unique()->name,
            'type' => $this->faker->randomElement(collect(Offer::OFFER_TYPE)->keys()->toArray()),
            'amount' => random_int(5, 20),
            'status' => random_int(0, 1),
            'start_at' => $this->faker->dateTimeBetween('- 5 days', '+ 5days'),
            'expire_at' => function($attributes) {
                return Carbon::instance($attributes['start_at'])->addDays(random_int(1, 10));
            }
        ];
    }
}
