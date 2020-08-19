<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    // protected $table = "uses";
    protected $fillable = ['id','name'];
    public function tools(){
    	return $this->hasMany('App\Tool');
    }
}
