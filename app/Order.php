<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'no_regis', 'title', 'users_id', 'tools_id', 'start', 'end', 'date', 'time_start', 'time_end', 'attend', 'purpose', 'sample', 'unique', 'approves_id'];
    public function times(){
    	return $this->belongsTo('App\Time');
    }
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
    public function users(){
    	return $this->belongsTo('App\User');
    }
    public function approve(){
        return $this->belongsTo('App\Approve');
    }
}
