<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;
use App\Models\User;
use Database\Factories\OrderFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)
            ->has(ShippingAddress::factory())
            ->has(Order::factory()->has(OrderDetail::factory()->count(random_int(1,10)), 'orderDetails')
            ->count(random_int(1,20)), 'orders')
            ->create();
    }
}
