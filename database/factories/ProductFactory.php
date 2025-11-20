<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Unit;
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
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'sku' => fake()->unique()->bothify('SKU-###-???'),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'cost' => fake()->randomFloat(2, 1, 100),
            'price' => fake()->randomFloat(2, 10, 100),
            'stock' => fake()->numberBetween(0,100),
            'unit_id' => Unit::factory(),
        ];
    }
}
