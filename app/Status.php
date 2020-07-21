<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['id','name'];
    public function tools(){
    	return $this->hasMany('App\Tool');
    }
}
