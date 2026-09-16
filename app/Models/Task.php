<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    function cart_item(){
        return $this->belongsTo(Cart_Item::class);
    }

    public function table(): HasMany
    {
        return $this->hasMany(Timetable_task::class);
    }
    public function item()
    {
        return $this->cart_item->item();
    }

    public function category()
    {
        return $this->item->category();
    }

    public function markTransit(): void
    {
        $this->update([
            'Status' => 'transit',
        ]);
    }

    public function markPending(): void
    {
        $this->update([
            'Status' => 'pending',
        ]);
    }

    public function markCompleted(): void
    {
        $this->update(['Status' => 'completed']);
    }

    public function markCancelled(): void
    {
        $this->update(['Status' => 'cancelled']);
    }

    public function markProcessing(): void
    {
        $this->update(['Status' => 'processing']);
    }

}
