<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\PurchaseOrder;
use App\Models\StockMovement;
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
            'po_number' => fake()->unique()->bothify('PO-#####'),
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
            'status' => 'received',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (PurchaseOrder $po) {

            // Invoice
            $invoice = Invoice::factory()->create([
                'type' => 'purchase',
                'ref_id' => $po->id,
                'total' => $po->items()->sum('price'),
            ]);

            // Stock movement
            foreach ($po->items as $item) {
                StockMovement::factory()->create([
                    'item_id' => $item->item_id,
                    'type' => 'in',
                    'qty' => $item->qty,
                    'reference_type' => 'PO',
                    'reference_id' => $po->id,
                ]);
            }
        });
    }
}
