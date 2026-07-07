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
        $filename = 'posts/' . fake()->uuid() . '.jpg';
        Storage::disk('public')->put(
            $filename,
            UploadedFile::fake()->image('post.jpg', $width, $height)->get()
        );

        return [
            'user_id' => User::factory(),
            'description' => fake()->text(500),
            'image_path' => $filename,
            'image_width' => $width,
            'image_height' => $height,
        ];
    }
}
