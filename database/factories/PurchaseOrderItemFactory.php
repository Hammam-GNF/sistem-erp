<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrderItem>
 */
class PurchaseOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PurchaseOrderItem::class;
    public function definition(): array
    {
        $qty  = $this->faker->numberBetween(1, 20);
        $price = $this->faker->numberBetween(10000, 500000);

        return [
            'qty' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(2, 10000, 100000),
        ];
    }
}
