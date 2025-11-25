<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseRequest;
use App\Models\Role;
use App\Models\SalesOrder;
use App\Models\Supplier;
use App\Models\User;
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
        Role::factory(3)->create();
        User::factory(5)->create();

        Supplier::factory(10)->create();
        Customer::factory(20)->create();
        Item::factory(15)->create();

        PurchaseRequest::factory(10)->create();
        SalesOrder::factory(10)->create();
    }
}
