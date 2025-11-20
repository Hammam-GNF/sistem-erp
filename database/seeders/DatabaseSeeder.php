<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
     {
        // Roles
        Role::factory(3)->create();

        // Users
        User::factory(10)->create();

        // Units
        Unit::factory(5)->create();

        // Products
        Product::factory(10)->create();

        // Warehouses
        Warehouse::factory(3)->create();

        // Suppliers
        Supplier::factory(10)->create();

        // Purchase Orders
        PurchaseOrder::factory(10)
        ->has(
            PurchaseOrderItem::factory()->count(3),
            'items'
        )
        ->create();

        // Purchase Invoice
        PurchaseInvoice::factory(10)
        ->has(
            PurchaseInvoiceItem::factory()->count(3),
            'items'
        )
        ->create();
    }
}
