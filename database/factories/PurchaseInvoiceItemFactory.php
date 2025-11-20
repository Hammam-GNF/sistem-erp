<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseInvoiceItem>
 */
class PurchaseInvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PurchaseInvoiceItem::class;
    public function definition(): array
    {
        $qty = fake()->randomFloat(2, 1, 20);
        $price = fake()->randomFloat(2, 10000, 300000);

        return [
            'purchase_invoice_id' => PurchaseInvoice::factory(),
            'product_id'          => Product::factory(),
            'qty'                 => $qty,
            'price'               => $price,
            'subtotal'            => $qty * $price,
        ];
    }
}
