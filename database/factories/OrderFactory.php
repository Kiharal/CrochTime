<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'cart_id' => Cart::factory(),
            'location'=> fake()->city(),
            'payment'=> self::payment_method(),
            'condition'=> self::condition_of_del(),
            'subtotal'=> 500,
            'service'=> 75,
            'delivery'=> fake()->word(),
            'grandtotal'=> 1250,
            'created_at' =>now(),
            'updated_at' =>now(),
        ];
    }

    static function payment_method(){
            
            switch(random_int(1, 4)){
                case 1:
                    return "Card";
                case 2:
                    return "Cash";
                case 3:
                    return "Mpesa";
                case 4:
                    return "Paypal";
                default:
                    return "Apple Pay";
            }
    }

    static function condition_of_del(){
            switch(random_int(1, 3)){
                case 1:
                    return "Good";
                case 2:
                    return "Opened but good";
                case 3:
                    return "Missing items";
                default:
                    return "Damaged";
            }
    }

}
