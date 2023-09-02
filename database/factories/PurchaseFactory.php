<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice'           => $this->faker->str_random(7),
            'purchase_date'     => $this->faker->date(),
            'total_purchase'    => $this->faker->randomNumber(),
        ];
    }
}
