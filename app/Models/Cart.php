<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
     /** @use HasFactory<\Database\Factories\cartFactory> */
    use HasFactory;
    protected $fillable = [
        'status'
    ];

    public function item(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
