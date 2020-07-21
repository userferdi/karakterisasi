<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'no_id', 'no_hp', 'institution', 'role'
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

    public function Roles(){
        return $this->belongsTo('App\Role');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function hasAnyRoles($Roles){
        return null !== $this->roles()->whereIn('name', $Roles)->first();
    }
    public function hasAnyRole($Role){
        return null !== $this->roles()->where('name', $Role)->first();
    }
}
