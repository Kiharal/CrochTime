<?php

namespace App\Faker;

class CrochetImageProvider{
    public function image($width, $height){
        return [
            sprintf("https://unsplash.com/s/photos/crochet-products")
        ];
    }
    
}

?>