<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'instagram' => fake()->word(),
            'password' => 'password',
            'email' => fake()->email(),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    public function unverified(): static{
        return $this->state(fn ($attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function myEmail(): static{
        return $this->state(fn ($attributes) => [
            'email' => 'pharoahm50@gmail.com',
            'password' => 'password',
        ]);
    }
}
