<?php

namespace App;

use App\Notifications\BuyerResetPasswordNotification;
use App\Notifications\BuyerVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new BuyerVerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new BuyerResetPasswordNotification($token));
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function premium()
    {
        return $this->hasOne(Premium::class, 'user_id', 'id');
    }
}
