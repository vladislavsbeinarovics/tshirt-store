<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            'gender' => $this->faker->randomElement(['men', 'women', 'unisex']),
            'color' => $this->faker->safeColorName(),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'image_path' => 'black-tshirt.jpg',
        ];
    }
}
