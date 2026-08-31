<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        Task::all()
            ->select('*',
                    DB::raw('load - done AS Remainder'))
            ->get();

    }
}
