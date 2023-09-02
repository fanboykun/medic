<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Unit;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $unit = Unit::factory()->count(1)->create();
        $cat = Category::factory()->count(1)->create();
        // var_dump($cat);
        Supplier::factory()->count(1)
        ->has(Medicine::factory()->count(10)
            ->state(function (array $attributes) use($cat, $unit) {
                return [
                    'category_id' => $cat->first()->id,
                    'unit_id' => $unit->first()->id,
                ];
            })
        )->create();
    }
}
