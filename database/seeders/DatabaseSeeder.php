<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\Sell;
use App\Models\Unit;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create();
        $unit = Unit::factory()->create();
        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create();
        $medicine = Medicine::factory()->count(10)->state(function (array $attributes){
            return [
                'stock' => 5,
                'purchase_price' => 150000,
                'selling_price' => 200000,
            ];
        })
        ->for($unit)
        ->for($category)
        ->for($supplier)->create();

        Purchase::factory()->count(1)
        ->for($supplier)
        ->hasAttached($medicine,
        ['quantity' => 5, 'purchase_price' => 150000]
        )->create();

        Sell::factory()
        ->state(function (array $attributes) use($medicine){
            return [
                'total_sell' => (float) 2 * $medicine->first()->selling_price
            ];
        })
        ->hasAttached($medicine->first(),
            [
                'selling_price' => $medicine->first()->selling_price,
                'quantity' => 2
            ])->create();

        $medicine->first()->update([
            'stock' => 3
        ]);

    }

}
