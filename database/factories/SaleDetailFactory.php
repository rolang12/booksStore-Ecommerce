<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2,1,100000),
            'quantity' => $this->faker->numberBetween(1,10),
            'product_id' => Product::all(['id'])->random(),
            'sale_id' => Sale::all(['id'])->random(),
        ];
    }
}
