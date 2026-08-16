<?php

namespace Database\Factories;

use App\Models\cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<cart>
 */
class cartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_name' => fake()->name(),
        ];
    }
}
