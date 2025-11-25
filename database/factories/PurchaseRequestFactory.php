<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PurchaseRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pr_number' => fake()->unique()->bothify('PR-#####'),
            'requested_by' => User::inRandomOrder()->first()->id,
            'status' => 'approved',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (PurchaseRequest $pr) {
            // PR items
            $items = Item::inRandomOrder()->take(rand(1,5))->get();

            foreach ($items as $item) {
                PurchaseRequestItem::factory()->create([
                    'purchase_request_id' => $pr->id,
                    'item_id' => $item->id,
                    'qty' => rand(1, 10),
                ]);
            }

            // 70% PR → jadi PO
            if (rand(1,100) > 30) {
                $po = PurchaseOrder::factory()->create([
                    'purchase_request_id' => $pr->id,
                ]);

                foreach ($pr->items as $prItem) {
                    PurchaseOrderItem::factory()->create([
                        'purchase_order_id' => $po->id,
                        'item_id' => $prItem->item_id,
                        'qty' => $prItem->qty,
                        'price' => Item::find($prItem->item_id)->price,
                    ]);
                }
            }
        });
    }
}
