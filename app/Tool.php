<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['name','code','descrip','sample','image','actives_id','labs_id','usages_id'];
    public function actives(){
    	return $this->belongsTo('App\Active');
    }
    public function labs(){
    	return $this->belongsTo('App\Lab');
    }
    public function usages(){
        return $this->belongsTo('App\Usage');
    }
    public function prices(){
        return $this->hasMany('App\Price');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function schedules(){
        return $this->hasMany('App\Schedule');
    }
}
