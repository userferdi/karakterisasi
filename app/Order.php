<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'users_id', 'tools_id', 'plans_id', 'attend', 'purpose', 'sample', 'unique'];
    public function plans(){
        return $this->belongsTo('App\Plan');
    }
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
    public function users(){
    	return $this->belongsTo('App\User');
    }
    public function schedules(){
        return $this->hasOne('App\Schedule');
    }
    public function bookings(){
        return $this->hasOne('App\Booking');
    }
    public function approves(){
        return $this->hasOne('App\Approve');
    }
}
