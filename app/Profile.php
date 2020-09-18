<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['users_id', 'no_id', 'no_hp', 'university', 'faculty', 'study_program', 'image', 'institution', 'address', 'email_dosen', 'name_dosen', 'no_id_dosen', 'no_hp_dosen', 'university_dosen', 'faculty_dosen', 'study_program_dosen'];
    public function users(){
    	return $this->belongsTo('App\User');
    }
}
