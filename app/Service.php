<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['id','name', 'tools_id'];
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
}
