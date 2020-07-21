<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id','title','users_id','tools_id','start','end'];
    public function users(){
    	return $this->belongsTo('App\User');
    }
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
}
