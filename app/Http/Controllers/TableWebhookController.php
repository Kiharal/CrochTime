<?php

namespace App\Http\Controllers;

use App\Broadcasting\viewTimetableChannel;
use App\Events\ShowTable;
use App\Models\Task;
use App\Models\Timetable;
use App\Models\Timetable_task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use League\Config\Exception\ValidationException;
use Throwable;

class TableWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$this->validateRequest($request)){
            Log::info('Invalid data for request: ', ['data' =>  $request->input('request_id')]);
        }
        
        $validator = Validator::make($request->all(),[
        'request_id' => 'required|exists:timetables,id',
        'status' => 'required|in:completed',
        'items' => 'required|array',
        ]);
    
        if($validator->fails()){
            Log::info('Failed validation.', ['error' => $validator->errors()]);
        }

        $validated = $validator->validated();
        $tables = $validated['items'];
        $request_id = $validated['request_id'];

        try{
            DB::transaction(function () use ($tables, $request_id) {
                foreach($tables as $key=>$table){
                    $extra = $key == 'extra';
                    foreach($table as $item){
                        if(!Task::findOrFail($item['id'])){
                            Log::info('Invalid task.', ['data' => $request_id]);
                            return view('welcome')->with(['message' => 'Invalid task']);
                        }
                        Timetable_task::create([
                            'task_id' => $item['id'],
                            'timetable_id' => $request_id,
                            'is_extra' => $extra,
                            'time_assigned' =>$item['time']
                        ]);
                    }
                }

            });
        }
        catch(Throwable $e){
            Log::info('Timtetable insertion failure.', ['data' => $e]);
        }

        $timetable = Timetable::findOrFail($request_id);
        if($timetable->status == 'completed'){
            return response()->json(['message' => 'Table alredy processed']);
        }
        else if($timetable->status == 'failed'){
            return response()->json(['message' => 'Timetable failed to process']);
        }
        else if($timetable->status == 'processing'){
            $timetable->markCompleted();
            broadcast(new ShowTable($timetable));
        }
        return response()->json(['message' => 'Seen','status' => $timetable->status]);
        
    }

    private static function validateRequest(Request $request){
        $data = $request->getContent();
        $expected = hash_hmac('sha256', $data, config('services.secrets.webhook'));
        $authHeader = $request->header('X-Signature');
        return hash_equals($expected, $authHeader);
    }


}
