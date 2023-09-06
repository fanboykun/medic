<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'storage' => $this->faker->text(),
            'expired' => Carbon::now()->addMonths(3)->format('Y-m-d'),
            'description' => $this->faker->text(),
            'purchase_price' => $this->faker->randomNumber(5),
            'selling_price' => $this->faker->randomNumber(5),

        ];
    }
}
