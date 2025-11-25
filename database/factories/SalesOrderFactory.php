<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Payment;
use App\Models\SalesOrder;
use App\Models\StockMovement;
use App\Models\SalesOrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SalesOrderFactory extends Factory
{
    protected $model = SalesOrder::class;
    public function definition(): array
    {
        return [
            'so_number' => fake()->unique()->bothify('SO-#####'),
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'status' => 'shipped',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (SalesOrder $so) {

            $items = Item::inRandomOrder()->take(rand(1,5))->get();

            foreach ($items as $item) {
                SalesOrderItem::factory()->create([
                    'sales_order_id' => $so->id,
                    'item_id' => $item->id,
                    'qty' => rand(1, 5),
                    'price' => $item->price,
                ]);

                StockMovement::factory()->create([
                    'item_id' => $item->id,
                    'type' => 'out',
                    'qty' => rand(1,5),
                    'reference_type' => 'SO',
                    'reference_id' => $so->id,
                ]);
            }

            $invoice = Invoice::factory()->create([
                'type' => 'sales',
                'ref_id' => $so->id,
                'total' => $so->items()->sum('price'),
            ]);

            // 60% paid
            if (rand(1,100) <= 60) {
                Payment::factory()->create([
                    'invoice_id' => $invoice->id,
                ]);
            }
        });
    }
}
