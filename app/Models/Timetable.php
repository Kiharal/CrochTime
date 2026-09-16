<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timetable extends Model
{
    protected $fillable = [
        'max_time',
        'completed_at',
        'status',
        'error_message'
    ];

    protected $cast = ['completed_at' => 'datetime'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Timetable_task::class);
    }

    public function markCompleted()
    {
        $this->update(['status' => 'completed']);
    }
    public function markFailed()
    {
        $this->update(['status' => 'failed']);
    }
    public function markPending()
    {
        $this->update(['status' => 'pending']);
    }
    public function markProcessing()
    {
        $this->update(['status' => 'processing']);
    }

    
}
