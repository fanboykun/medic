<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sell>
 */
class SellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice'       => $this->faker->randomNumber(),
            'saler_name'    => $this->faker->name(),
            'sell_date'     => now(),
            'total_sell'    => $this->faker->randomNumber(),
        ];
    }
}
