<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DenominationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2,1,100000),
            'type' => $this->faker->randomElement(['Cash','Coin','Other'])
        ];
    }
}
