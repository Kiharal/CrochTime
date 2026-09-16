<?php

namespace App\Http\Controllers;

use App\Jobs\createTimetableJob;
use App\Models\Task;
use App\Models\Timetable;
use DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = DB::table('tasks')
                ->select('*',
                        DB::raw('total_time - done AS Work_remaining'))
                ->get(10);
        
        return view('owner.view', ["tasks"=>$tasks]);
    }

    public function setTable(){
        $timetable = Timetable::create([
                'max_time' => 8
        ]);
        $timetable->markProcessing();
        createTimetableJob::dispatch($timetable);

        return view('owner.processing');
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
}
