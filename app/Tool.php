<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['id','name','code','descrip','sample','image','statuses_id','labs_id','periods_id'];
    public function statuses(){
    	return $this->belongsTo('App\Status');
    }
    public function labs(){
    	return $this->belongsTo('App\Lab');
    }
    public function periods(){
        return $this->belongsTo('App\Period');
    }
    public function service(){
        return $this->hasMany('App\Service');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
