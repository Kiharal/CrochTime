<?php

namespace App\Http\Controllers;

use App\Jobs\createTimetableJob;
use App\Models\Task;
use App\Models\Timetable;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::select('*',
                        DB::raw('total_time - done AS Work_remaining'))
                ->with('cartItem.cart.order:id,cart_id,due_date')
                ->get(10);
        
        
        return view('owner.view', ["tasks"=>$tasks]);
    }

    public function setTable(){
        $timetable = Timetable::create([
                'max_time' => 8
        ]);
        $timetable->markProcessing();
        createTimetableJob::dispatch($timetable);

        return view('owner.processing', compact('timetable'));
    }

    public function test(){
        
        $request = Task::select('tasks.id',
                                DB::raw('(tasks.total_time - tasks.done) as process_time'),
                                DB::raw('DATEDIFF(orders.due_date, CURDATE())'))
                        ->whereIn('tasks.Status', ['pending', 'processing'])
                        ->join('cart_item', 'tasks.cart_item_id', 'cart_item.id', 'inner')
                        ->join('carts', 'cart_item.cart_id', '=', 'carts.id', 'inner')
                        ->join('orders', 'carts.order_id', '=', 'orders.id', 'inner')
                        ->get();
        dd($request->map->only(['id', 'process_time', 'complexity']));
    }

    public function viewTable($id){
        //validate user
        //check if value exists
        try{
            $timetable = Timetable::findOrFail($id);
            $tasks = $timetable->tasks != null ? $timetable->tasks : $timetable->markFailed();

        }
        catch(ModelNotFoundException $e){
            Log::info("Model doesn't exist", ['error' => $e]);
            return response()->json(['message' => 'This item does not exist, biatch']);
        }

        //render values
        return view('welcome', compact('tasks'));

    }
}
