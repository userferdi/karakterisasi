<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{
    protected $fillable = ['id','order_id','no_regis','date','times_id'];
    public function orders(){
        return $this->belongsTo('App\Order');
    }
    public function times(){
    	return $this->belongsTo('App\Time');
    }
    public function payments(){
        return $this->hasOne('App\Payment', 'approves_id');
    }
}
