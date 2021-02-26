<?php

namespace Database\Factories;

use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->titleMale,
            'last_name' => $this->faker->name,
            'email' => $this->faker->email,
            'country' => $this->faker->country,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'zipcode' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->streetAddress,
        ];
    }
}
