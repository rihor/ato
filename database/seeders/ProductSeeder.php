<?php

namespace Database\Seeders;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(3)
            ->create([
                'status' => ProductStatus::DRAFT,
            ]);
        Product::factory()
            ->count(2)
            ->create([
                'status' => ProductStatus::INACTIVE,
            ]);
        Product::factory()
            ->count(10)
            ->create([
                'status' => ProductStatus::ACTIVE,
            ]);
        Product::factory()
            ->count(7)
            ->create([
                'status' => ProductStatus::WAITING_APPROVAL,
            ]);
        Product::factory()
            ->count(12)
            ->create([
                'status' => ProductStatus::DISCONTINUED,
            ]);
    }
}
