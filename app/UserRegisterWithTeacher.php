<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegisterWithTeacher extends Model
{
    protected $table = 'lessons';
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function timing()
    {
        return $this->belongsTo('App\TeacherTiming');
    }
    public function homework(){
        return $this->hasOne('App\Homework','lesson_id');
    }
}
