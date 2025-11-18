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
        $types = ['in', 'out', 'transfer', 'adjust'];
        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'qty' => fake()->randomFloat(3, 1, 100),
            'type' => fake()->randomElement($types),
            'reference_type' => null,
            'reference_id' => null,
            'note' => fake()->sentence(),
            'user_id' => User::factory(),
        ];
    }
}
