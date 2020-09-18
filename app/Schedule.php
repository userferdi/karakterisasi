<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['id','title','start','end','tools_id','orders_id'];
    public function orders(){
    	return $this->belongsTo('App\Order');
    }
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
}
