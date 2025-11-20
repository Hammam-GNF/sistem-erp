<?php

namespace Database\Factories;

use App\Models\PurchaseInvoice;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseInvoice>
 */
class PurchaseInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PurchaseInvoice::class;
    public function definition(): array
    {
        return [
            'pi_number'    => 'PI-' . now()->format('Ym') . '-' . fake()->unique()->numberBetween(1000, 9999),
            'po_id'        => PurchaseOrder::factory(),
            'supplier_id'  => Supplier::factory(),
            'pi_date'      => fake()->date(),
            'due_date'     => fake()->date(),
            'total_amount' => fake()->randomFloat(2, 100000, 5000000),
            'notes'        => fake()->sentence(),
            'status'       => fake()->randomElement(['unpaid', 'partial', 'paid']),
        ];
    }
}
