<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomFloat(2,1,10000),
            'items' => $this->faker->numberBetween(1, 10),
            'paymentway' => $this->faker->randomElement(['Cash','Credit Card', 'Debit Card']),
            'status' => $this->faker->randomElement(['PAID','DISPATCHED','CANCELED','RECEIVED']),
            'user_id' => User::all(['id'])->random(),

        ];
    }
}
