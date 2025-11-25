<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
class StockMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = StockMovement::class;
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['in','out']),
            'qty' => fake()->numberBetween(1,10),
            'reference_type' => 'Manual',
            'reference_id' => null,
        ];
    }
}
