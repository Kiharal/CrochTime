<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\Timetable;
use App\Services\createTimetable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class createTimetableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 
    public int $tries = 3;
    public array $backoff = [10, 30, 60];

    
    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Timetable $timetable)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tasks = Task::select('tasks.id',
                                DB::raw('(tasks.total_time - tasks.done) as process_time'),
                                DB::raw('DATEDIFF(orders.due_date, CURDATE()) as complexity'))
                        ->whereIn('tasks.Status', ['pending', 'processing'])
                        ->join('cart_item', 'tasks.cart_item_id', 'cart_item.id', 'inner')
                        ->join('carts', 'cart_item.cart_id', '=', 'carts.id', 'inner')
                        ->join('orders', 'carts.order_id', '=', 'orders.id', 'inner')
                        ->get();
        $client = new createTimetable();
        $client->submit($this->timetable, $tasks->map->only(['id', 'process_time', 'complexity'])->toArray());

    }
}
