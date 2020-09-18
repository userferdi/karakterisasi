<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'no_form', 'no_regis', 'users_id', 'tools_id', 'date1', 'times1_id', 'date2', 'times2_id', 'date3', 'times3_id', 'attend', 'purpose', 'sample', 'unique', 'statuses_id'];
    public function plans(){
        return $this->belongsTo('App\Plan');
    }
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
    public function users(){
    	return $this->belongsTo('App\User');
    }
    public function statuses(){
        return $this->belongsTo('App\Status');
    }
    public function verifs(){
        return $this->belongsTo('App\Verif');
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
