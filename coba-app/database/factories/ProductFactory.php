<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code_product' => fake()->randomNumber(8),
            'name' => fake()->text(12),
            'description' => fake()->address(),
            'qty' => fake()->randomDigit(5),
            'price' => fake()->randomDigit(10),
        ];
    }
}
