<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'gender', 'age', 'type', 'management_level', 'joining_date', 'professional_qualifications', 'school_id'
    ];

    public function school(){
        return $this->belongsTo('App\School');
    }
}
