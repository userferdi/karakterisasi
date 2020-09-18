<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $fillable = ['id','name'];
    public function tools(){
    	return $this->hasMany('App\Tool');
    }
    public function times(){
    	return $this->belongsToMany('App\Time');
    }
}
