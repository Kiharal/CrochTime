<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Item extends Model
{
    protected $table = 'cart_item';
    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity'
    ];


}
