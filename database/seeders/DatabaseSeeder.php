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
        $units = Unit::factory(5)->create();
        $categories = Category::factory(5)->create();
        $suppliers = Supplier::factory(5)->create();
        $iteration = 0;
        while ($iteration < 5) {
            $unit = $units[$iteration];
            $category = $categories[$iteration];
            $supplier = $suppliers[$iteration];

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

            Purchase::factory()
            ->state(function (array $attributes) use($medicine){
                return [
                    'total_purchase' => (float) ( (int) count($medicine) * 5 ) * 150000 // 10 item, 5 quantity
                ];
            })
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
            $iteration++;
        }

    }

}
