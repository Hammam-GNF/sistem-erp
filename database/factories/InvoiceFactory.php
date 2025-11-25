<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' => fake()->unique()->bothify('INV-#####'),
            'type' => 'sales',
            'ref_id' => 1,
            'total' => fake()->randomFloat(2, 10000, 500000),
            'status' => 'unpaid',
        ];
    }
}
