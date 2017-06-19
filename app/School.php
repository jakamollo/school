<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function user(){
        return $this->hasMany('App\User', 'school_id');
    }

    public function students(){
        return $this->hasMany('App\Student', 'school_id');
    }

    public function staffs(){
       return $this->hasMany('App\Staff', 'school_id');
    }
}
