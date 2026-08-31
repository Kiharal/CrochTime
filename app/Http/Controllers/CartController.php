<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Item;
use App\Models\Order;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function show(){
        $cart = session('cart');
        $subTotal = 0;
        $total = 0;

        //Total for all items
        foreach($cart as $item_id => $item){
            $total = ($item['qty'] ?? 0) * ( $item['price'] ?? 0);
         
            $cart[$item_id]['total'] = $total;
            $subTotal += $total;
        }
        session(['cart' => $cart]);

        return view('customer.checkout', ['cart' => $cart, 'total' =>$subTotal]);
    }


    public function addItem(Request $request){
        $id = $request->input('item_id');
        $item = Item::findOrFail($id);
        $cart = session('cart', []);
        $cart[$item->id] = [
            'item_name' => $item->item_name,
            'price' => $item->price,
            'qty' => ($cart[$item->id]['qty'] ?? 0) + 1,
            'complexity' =>  $item->category->max_time,
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

    public function store(Request $request){

        $cart_items = $request->session()->get('cart');
        $request->validate([
            'subTotal' => ['required'],
        ]);

        Validator::make(['cart' => $cart_items], [
            'cart' => 'required',
            'cart.*.item_name' => 'required',
            'cart.*.price' => 'required|integer',
            'cart.*.qty' =>'required|integer',
            'cart.*.total' => 'required'
        ],
        )->validate();

        //Validate total
        //The tottal should be equal to the calculated total, otherwise the data entered is false
        //For future structure, revalidate the session
        //Confirm validity of subTotal
            /* if($total != $request->input('subTotal')){
                    return redirect()->route('cart.show')->with(['message' => 'Discrepancy in totals, please resend. t1: ' . $total . " t2:" . $request->input('subTotal')]);
            } */


        try {
            DB::transaction(function () use ($cart_items) {
                $cart = Cart::create([
                    'status' => 'pending'
                ]);

                $total = 0 ;

                foreach($cart_items as $item_id => $item){
                    //Determine complexity of task

                    
                    $cart_item = Cart_Item::create([
                        'cart_id' => $cart->id,
                        'item_id' => $item_id,
                        'quantity' => $item['qty']
                    ]);
                    $task = Task::create([
                        'cart_item_id' => $cart_item->id,
                        'total_time' => $item['complexity'] * $item['qty'],
                        'done' => 0,
                    ]);
                    $task->pendingTask();

                    $total += $item['qty'] * $item['price'];
                }

                OrderController::store($cart->id, $item, $item_id, $total);
            });

        }
        catch(Throwable $e)
        {
            return redirect()->back()->with(['error', ('Error: ' . $e)]);
        }
        
        return redirect()->route('launch')->with(['success' => 'Order placed successfully']);
    }
}
