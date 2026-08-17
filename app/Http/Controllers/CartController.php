<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function show(){
        $cart = session('cart');
        $grandTotal = 0;
        $total = 0;

        //Total for all items
        foreach($cart as $item_id => $item){
            $total = ($item['qty'] ?? 0) * ( $item['price'] ?? 0);
         
            $cart[$item_id]['total'] = $total;
            $grandTotal += $total;

        }
        return view('customer.checkout', ['cart' => $cart, 'total' =>$grandTotal]);
    }


    public function addItem(Request $request){
        $id = $request->input('item_id');
        $item = Item::findOrFail($id);
        $cart = session('cart', []);
        $cart[$item->id] = [
            'item_name' => $item->item_name,
            'price' => $item->price,
            'qty' => ($cart[$item->id]['qty'] ?? 0) + 1,
        ];
        session(['cart' => $cart]);
        return json_encode([
            'qty' => $cart[$item->id]['qty'],
            'count' => empty($cart),
            
            ]);
    }

    public function removeItem(Request $request){
        $id = $request->input('item_id');
        $cart = session('cart', []);

        if( isset($cart[$id]) && $cart[$id]['qty'] > 1 ){
            $cart[$id]['qty'] -= 1;
            //Update session cart
            session(['cart' => $cart]);

            //return the quantity and whether items exist in the cart
            return json_encode([
                'qty' => $cart[$id]['qty'],
                'count' => empty($cart),
                ]);
            }
        elseif( isset($cart[$id]) && $cart[$id]['qty'] == 1 ){
            unset($cart[$id]);
            session(['cart' => $cart]);
            return json_encode([
                'qty' => 0,
                'count' => empty($cart),
                ]);
        }
        else {
            return json_encode([
                'qty' => 0,
                'count' => empty($cart),
                ]);
        }
    }

    public function deleteItem(Request $request){
        #validate data
        $request->validate([
            'item_id' => ['required'],
            'total' => ['required']
        ]);
        #validate id and total

        $id = $request->input('item_id');
        $total = $request->input('total');
        $cart = session('cart');
        $message = $cart[$id]['item_name'] . ' has been deleted sucessfully';
        $total -= $cart[$id]['price'] * $cart[$id]['qty'];
        $total = "Total: Ksh. " . number_format($total);
        unset($cart[$id]);
        session(['cart' => $cart]);
        
        return json_encode(['message' => $message, 'total' => $total, 'change' => true]);

    }
}
