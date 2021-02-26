<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subtotal = $this->faker->numberBetween(100, 5000);
        $shipping_method = ShippingMethod::inRandomOrder()->first();
        $tax = $this->faker->numberBetween(1, 50);

        return [
            'coupon_id' => null,
            'shipping_method_id' => $shipping_method->id,
            'payment_method' => $this->faker->creditCardType,
            'shipping_charge' => $shipping_method->charge,
            'tax' => $tax,
            'sub_total' => $subtotal,
            'grand_total' => $subtotal + $shipping_method->charge + $tax,
            'payment_status' => $this->faker->randomElement(array_keys(Order::PAYMENT_STATUS)),
            'order_status' => $this->faker->randomElement(array_keys(Order::ORDER_STATUS)),
        ];
    }
}
