<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PurchaseOrder::class;
    public function definition(): array
    {
        return [
            'po_number'   => 'PO-' . $this->faker->unique()->numerify('########'),
            'supplier_id' => Supplier::inRandomOrder()->value('id') ?? Supplier::factory(),
            'po_date'     => $this->faker->date(),
            'status'      => $this->faker->randomElement(['draft', 'ordered', 'received']),
            'notes'       => $this->faker->sentence(6),
        ];
    }
}
