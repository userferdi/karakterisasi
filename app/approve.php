<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{
    public function orders(){
        return $this->belongsTo('App\Order');
    }
    public function times(){
    	return $this->belongsTo('App\Time');
    }
}
