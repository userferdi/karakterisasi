<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = ['id','name','time_start','time_end'];
    public function bookings(){
        return $this->hasMany('App\Order');
    }
    public function usages(){
    	return $this->belongsToMany('App\Usage');
    }
}
