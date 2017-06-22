<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'body', 'user_id', 'attachment', 'school_id'
    ];

    public function user(){
       return $this->belongsTo('App\User');
    }
}
