<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'item_name',
        'image_path',
        'image_width',
        'image_height',
        'user_id',
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
