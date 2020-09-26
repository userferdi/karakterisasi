<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'no_id', 'no_hp', 'university', 'faculty', 'study_program', 'image', 'institution', 'address', 'email_lecturer'];
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
