<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Unsplash\HttpClient;
use Unsplash\Search;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    private int $page = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        HttpClient::init([
            'applicationId'	=> config('services.unsplash.access'),
	        'secret'	=> config('services.unsplash.secret'),
	        'callbackUrl'	=> 'http://localhost:8000',
	        'utmSource' => config('services.unsplash.app_name')
        ]);
        $avatar =Search::photos('headshot', $this->page, 1, 'portrait')->getResults();
        $banner = Search::photos('business banner', $this->page, 1, 'landscape')->getResults();
        $this->page += 1;

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'avatar' => $avatar[0]['urls']['raw'],
            'banner'=>$banner[0]['urls']['raw'],
            'role' => 'crocheter',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function myEmail(): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => 'pharoahm50@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
