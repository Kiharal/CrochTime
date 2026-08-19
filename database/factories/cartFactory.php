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
            'status' => fake()->name(),
        ];
    }

    static function status_def()
    {
        switch(random_int(1, 3))
        {
            case 1:
                return "Pending";
            case 2:
                return "Cancelled";
            case 3:
                return "Completed";
            default:
                return "Ordered";
        }
    }
}
