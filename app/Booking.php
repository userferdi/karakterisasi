<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['id','order_id','no_form','date1','times1_id','date2','times2_id','date3','times3_id','token','status','datetime','note', 'hide'];
    public function orders(){
        return $this->belongsTo('App\Order');
    }
    public function times1(){
    	return $this->belongsTo('App\Time', 'times1_id');
    }
    public function times2(){
    	return $this->belongsTo('App\Time', 'times2_id');
    }
    public function times3(){
    	return $this->belongsTo('App\Time', 'times3_id');
    }
}
