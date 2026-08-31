<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class category extends Model
{
    protected $fillable = [
        'category',
        'min_time',
        'max_time',
        'products'
    ];
    public $timestamps = false;

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }

}
