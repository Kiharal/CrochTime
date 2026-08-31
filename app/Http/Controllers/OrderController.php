<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    static function store($cartID, $cart_item, $itemID, $subtotal){
        Order::create([
                    'cart_id' => $cartID,
                    'location' => 'Nairobi',
                    'payment' => 'mpesa',
                    'condition' => 'Good',
                    'subtotal' => $subtotal,
                    'service' => 75,
                    'delivery' => 'John',
                    'grandtotal' => $subtotal + 75 + 100
                    ]);

    }
}
