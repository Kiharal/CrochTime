<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class colour_order extends Model
{
    /** @use HasFactory<\Database\Factories\ColourOrderFactory> */
    use HasFactory;

    protected $table = "colour_order";

    protected $fillable = [
        'item_id',
        'colour_item_id'
    ];

    public function item(): belongsToMany
    {
        return $this->belongsToMany(Item::class);
    }

    public function colour(): belongsToMany
    {
        return $this->belongsToMany(color_item::class);
    }

    public function colour_item(): BelongsToMany
    {
        return $this->belongsToMany(color_item::class);
    }
}
