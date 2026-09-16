<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart_Item extends Model
{
    protected $table = 'cart_item';
    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity'
    ];


    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }


}
