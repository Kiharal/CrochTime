<?php

namespace App\Models;

use App\Notifications\Customer\ResetPasswordNotification;
use App\Notifications\Customer\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


#use App\Models\Order;

class Customer extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;


    use Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'instagram',
        'password',
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

    public function sendEmailVerificationNotification(){
        return $this->notify(new VerifyEmailNotification);
    }

    public function sendPasswordResetNotification($token){
        return $this->notify(new ResetPasswordNotification($token));
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

}
