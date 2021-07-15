<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        return [
            'product_name' => $this->faker->sentence,
            'product_details' => $this->faker->text(1000),
            'product_image' => 'http://coffe-android.ir/image/headphone.png',
            'price' => $this->faker->numberBetween($min = 1500, $max = 2000),
            'rating' => $this->faker->randomFloat(),
            'status' => $this->faker->boolean(),

        ];
    }
}
