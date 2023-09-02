<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\Unit;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $unit = Unit::factory()->create();
        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create();

        Purchase::factory()->count(1)
        ->for($supplier)
        ->hasAttached(Medicine::factory()->count(10)
        ->for($unit)
        ->for($category)
        ->for($supplier),
        ['quantity' => 5, 'purchase_price' => 150000]
        )->create();
    }
}
