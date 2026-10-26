<?php

namespace Database\Factories;

use App\Models\Item;
use Unsplash\HttpClient;
use Unsplash\Search;
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
    private int $pages = 1;

    public function definition(int $width=400, int $height=400): array
    {
        HttpClient::init([
            'applicationId' => config('services.unsplash.access'),
            'secret' => config('services.unsplash.secret'),
            'callback' => 'callback',
            'utmSource' => config('services.unsplash.app_name'),
        ]);

        $search = 'crochet';
        $pages = $this->pages;
        $per_page = 1;
        $orientation = 'landscape';

        $this->pages +=1;

        $payload = Search::photos($search, $pages, $per_page, $orientation);
        $result = $payload->getResults();


        $filename = $result[0]['urls']['small'];

        
        return [
            'user_id' => User::factory(),
            'description' => fake()->text(500),
            'price' => 10000,
            'image_path' => $filename,
            'image_width' => $width,
            'image_height' => $height,
            'waist' => 30,
            'length' => 30,
            'chest' => 30,
            'item_name' => $this->faker->word,
            'category_id' => random_int(1, 20),
        ];
    }
}
