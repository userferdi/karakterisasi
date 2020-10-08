<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'no_id', 'no_hp', 'university', 'faculty', 'study_program', 'image', 'institution', 'address', 'email_lecturer'];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function faculties(){
    	return $this->belongsTo('App\Faculty');
    }
    public function study_program(){
    	return $this->belongsTo('App\study_program');
    }
}
