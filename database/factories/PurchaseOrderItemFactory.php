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
            'purchase_order_id' => PurchaseOrder::inRandomOrder()->value('id') ?? PurchaseOrder::factory(),
            'product_id'        => Product::inRandomOrder()->value('id') ?? Product::factory(),
            'qty'               => $qty,
            'price'             => $price,
            'subtotal'          => $qty * $price,
        ];
    }
}
