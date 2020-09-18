<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = ['id','name','code','head','descrip'];
    public function tools(){
    	return $this->hasMany('App\Tool');
    }
    public function details(){
    	return $this->hasMany('App\Detail');
    }
}
