<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
            'name' => 'PT Sumber Rejeki',
            'contact_person' => 'Budi',
            'phone' => '081234567890',
            'email' => 'sumber@company.com',
            'address' => 'Jakarta'
            ],
            [
            'name' => 'CV Makmur Sentosa',
            'contact_person' => 'Ani',
            'phone' => '081987654321',
            'email' => 'makmur@company.com',
            'address' => 'Bandung'
            ],
        ]);
    }
}
