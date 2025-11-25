<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => strtoupper(fake()->unique()->bothify('SKU-#####')),
            'name' => fake()->word(),
            'unit' => 'pcs',
            'min_stock' => fake()->numberBetween(5, 20),
            'price' => fake()->randomFloat(2, 10000, 500000),
        ];
    }
}
