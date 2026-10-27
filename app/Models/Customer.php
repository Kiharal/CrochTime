<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#use App\Models\Order;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;


    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'instagram',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function casts(){
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

}
