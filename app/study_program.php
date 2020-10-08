<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class study_program extends Model
{
    public function profiles(){
    	return $this->hasMany('App\Profile');
    }
}
