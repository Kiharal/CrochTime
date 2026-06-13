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
                        DB::raw('Workload - Work_done AS Work_remaining'))
                ->paginate(10);
        
        return view('owner.view', ["tasks"=>$tasks]);
    }
}
