<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['id','quantity','service','no_invoice','no_receipt','approves_id','status'];
    public function approves(){
        return $this->belongsTo('App\Approve');
    }
}
