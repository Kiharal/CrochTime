<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(int $width=400, int $height=400): array
    {
        $filename = fake()->image();

        
        return [
            'user_id' => User::factory(),
            'description' => fake()->text(500),
            'price' => 10000,
            'image_path' => $filename,
            'image_width' => $width,
            'image_height' => $height,
            'item_name' => $this->faker->word,
            'category_id' => random_int(1, 20),
        ];
    }
}
