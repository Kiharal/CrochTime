<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Timetable_task extends Model
{
    protected $fillable =[
        'task_id',
        'timetable_id',
        'is_extra',
        'time_assigned',
        'status'
    ];

    protected $cast = [
        'is_extra' => 'boolean'
    ];

    public function timetable(): BelongsTo
    {
        return $this->belongsTo(Timetable::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function markCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }

    public function markPending(): void
    {
        $this->update(['status' => 'pending']);
    }

    public function markProcessing(): void
    {
        $this->update(['status' => 'processing']);
    }


}
