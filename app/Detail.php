<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['id','tools_id','descrip','sample','image'];
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
}
