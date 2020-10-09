<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['id','service', 'tools_id', 'price1','price2','price3','discount'];
    public function tools(){
    	return $this->belongsTo('App\Tool');
    }
}
