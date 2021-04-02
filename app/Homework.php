<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    public function lesson(){
        return $this->belongsTo('App\UserRegisterWithTeacher','lesson_id');
    }
}
