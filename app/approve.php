<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{
    protected $fillable = ['id','orders_id','no_regis','date','times_id','status'];
    public function orders(){
        return $this->belongsTo('App\Order');
    }
    public function times(){
    	return $this->belongsTo('App\Time');
    }
    public function payments(){
        return $this->hasOne('App\Payment', 'approves_id', 'id');
    }
}
