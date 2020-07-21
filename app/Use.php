<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Use extends Model
{
    protected $fillable = ['id','name'];
    public function tools(){
    	return $this->hasMany('App\Tool');
    }
}
