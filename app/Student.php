<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
      'first_name', 'last_name', 'email', 'gender', 'age', 'form', 'admission_date', 'school_id'
    ];

    public function school(){
        return $this->belongsTo('App\School');
    }
}
