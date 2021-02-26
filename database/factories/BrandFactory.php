<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->company;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'web_url' => $this->faker->url,
            'description' => $this->faker->sentence(200),
            'status' => $this->faker->numberBetween(0,1),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
