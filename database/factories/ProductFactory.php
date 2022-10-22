<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realTextBetween(10, 20),
            'description' => $this->faker->realTextBetween(100, 300),
            'price' => $this->faker->randomFloat(2,1,100000),
            'stock' => $this->faker->numberBetween(1, 10),
            'alerts' => $this->faker->numberBetween(1, 5),
            'editorial' => $this->faker->realTextBetween(10, 20),
            'presentation' => $this->faker->randomElement(['Tapa Blanda','Tapa Dura']),
            'edition' => $this->faker->numberBetween(1, 10),
            'language' => $this->faker->languageCode(),
            'n_pages' => $this->faker->numberBetween(100, 300),
            'year' => $this->faker->numberBetween(1900, 2022),
            'width' => $this->faker->randomFloat(2,1,50),
            'height' => $this->faker->randomFloat(2,1,50),
            'image' => $this->faker->image(),
            'barcode' => $this->faker->creditCardNumber(),
            'category_id' => Category::all(['id'])->random(),
            'authors_id' => Author::all(['id'])->random(),
        ];
    }
}
