<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherExperience extends Model
{
    public function teacher(){
        return $this->belongsTo("App\Teacher");
    }
}
