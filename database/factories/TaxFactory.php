<?php

namespace Database\Factories;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tax::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement(collect(Tax::TAX_TYPE)->keys()->toArray()),
            'tax' => random_int(5,20),
            'status' => random_int(0,1),
        ];
    }
}
