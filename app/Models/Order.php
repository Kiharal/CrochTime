<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'location',
        'payment',
        'condition',
        'due_date',
        'subtotal',
        'service',
        'delivery',
        'grandtotal',
        'priority_days',
    ];


    protected $cast = ['due_date' => 'datetime'];

    function task(){
        return $this->belongsTo(Task::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
