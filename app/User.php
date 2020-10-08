<?php

namespace App;

use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'name', 'email_verified_at',
    ];

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

    public function sendEmailVerificationNotification(){
        $this->notify(new VerifyEmail);
    }
    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPassword($token));
    }
    public function profiles(){
        return $this->hasOne('App\Profile');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}
