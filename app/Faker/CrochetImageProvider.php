<?php

namespace App\Faker;

class CrochetImageProvider{
    public function imageUrl($width=640, $height=480){
        return 
            sprintf("https://unsplash.com/s/photos/crochet-products/%d/%d", $width, $height);
    }
    
}

?>