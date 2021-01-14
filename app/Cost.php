<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['id','payments_id','service','price','quantity'];
    public function payments(){
        return $this->belongsTo('App\Payment');
    }
}
