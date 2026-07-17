<?php

namespace App\Faker;

use Illuminate\Support\Facades\Http;

class CrochetImageProvider{
    public function imageUrl()
    {
        $response = Http::withHeaders(['Authorization' => 'Client-ID' .config('services.unsplash.api_KEY')])
                    ->get('https://api.unsplash.com/search/photos', [
                        'query' => 'random',
                        'per_page ' => 1,
                        'page' => rand(1, 20)
                    ]);

        return $response->json();
    }
    
}

?>