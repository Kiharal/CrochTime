<?php

namespace App\Events;

use App\Models\Timetable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShowTable implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Timetable $timetable;
    /**
     * Create a new event instance.
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('api.timetable_set.' . $this->timetable->id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'redirect_url' => route('viewTable', $this->timetable->id),
            'message' => 'success',
        ];
    }
}
