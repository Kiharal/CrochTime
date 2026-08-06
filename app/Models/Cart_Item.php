<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Item extends Model
{
    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity'
    ];


}
