<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['id','name','statuses_id','labs_id','details_id'];
    public function statuses(){
    	return $this->belongsTo('App\Status');
    }
    public function labs(){
    	return $this->belongsTo('App\Lab');
    }
    public function times(){
        return $this->belongsTo('App\Time');
    }
    public function details(){
    	return $this->hasOne('App\Detail');
    }
    public function service(){
        return $this->hasMany('App\Service');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
