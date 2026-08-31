<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'Status',
        'total_time',
        'done',
        'cart_item_id'
    ];


    function order(){
        return $this->belongsTo(Cart_Item::class);
    }

    public function completeTask(): void
    {
        $this->update([
            'Status' => 'completed',
        ]);
    }

    public function onTransit(): void
    {
        $this->update([
            'Status' => 'Transit',
        ]);
    }

    public function pendingTask(): void
    {
        $this->update([
            'Status' => 'pending',
        ]);
    }
}
