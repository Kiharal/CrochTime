<?php 
namespace App\Services;

use App\Models\Task;
use App\Models\Timetable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class createTimetable
{
//invoke constructor that logs base url and token

private string $baseUrl;
private string $bearerToken;

public function __construct()
{
    $this->baseUrl = config('services.python.url');
    $this->bearerToken = config('services.secrets.webhook');
}

public function submit(Timetable $tableRequest,$tasks)
{
    $body = [
        'request_id' => $tableRequest->id,
        'callback_url' => app('url'),
        'max_time' => $tableRequest->max_time,
        'laravel_tasks' => $tasks
    
    ];
    
    $response = Http::baseUrl($this->baseUrl)
    ->withToken($this->bearerToken)
    ->withHeaders(['Content-Type' => 'application/json'])
    ->retry(3, 200, throw: false)
    ->post('/createTable',[
        'request_id' => $tableRequest->id,
        'callback_url' => route('timetable.callback'),
        'max_time' => $tableRequest->max_time,
        'laravel_tasks' => $tasks
    
    ]);

    if($response->failed()){
        Log::error('Python rejected the request', [
            'status' => $response->status(),
            'result' => $response->body()
        ]);

        throw new RuntimeException(
            "Python microservice failed id: 1 data: " . $response->body()
        );
    }
    return redirect()->route('timetable.callback', $response);

}

}

?>