<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Cart $cart){
        $cart_items = Cart_Item::with('item:name, image_path')
                            ->where('cart_id', '=', 'cart->id')
                            ->get();
        return view('customer.checkout', compact('cart_items'));
    }
}
