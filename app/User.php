<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'password_confirmation','photo','type','gender', 'confirmed', 'new_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function school(){
        return $this->belongsTo('App\School');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function user_school(){
        $userType = $this->type();
        if($userType == 'admin'){
            $userSchool = School::where('admin', Auth::user()->id)->first();
            if(isset($userSchool)){
                return $userSchool;
            }else{
                return null;
            }
        }elseif($userType == 'student' || $userType == 'staff'){
            return School::where('id', Auth::user()->school_id)->first();
        }

    }

    public function type(){
        return Auth::user()->type;
    }

    public function isAdmin(){
        $type = $this->type();
        if($type == 'admin'){
            return $type;
        }
    }

    public function isStaff(){
        $type = $this->type();
        if($type == 'staff'){
            return $type;
        }
    }

    public function isStudent(){
        $type = $this->type();
        if($type == 'student'){
            return $type;
        }
    }

    public function user(){
        return Auth::user();
    }


}
