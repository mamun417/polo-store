<?php

namespace Database\Factories;

use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $needed_fee = $this->faker->numberBetween(10,50);
        return [
            'title' => $title,
            'slug' => slug($title),
            'applicable_amount' => $needed_fee,
            'charge' => $this->faker->randomElement([0, random_int(10,20)]),
            'status' => $this->faker->randomElement([0,1]),
        ];
    }
}
