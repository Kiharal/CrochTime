<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class color_item extends Model
{
    protected $fillable = [
        'color_name',
        'image_hash',
        'image_path',
        'r',
        'g',
        'b',
        'hex',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
