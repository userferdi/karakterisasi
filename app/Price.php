<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['id','service_id','price_1','price_2','price_3','diskon'];
    public function services(){
    	return $this->belongsTo('App\Service');
    }
}
