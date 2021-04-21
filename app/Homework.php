<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Homework extends Model
{
    public function lesson():BelongsTo{
        return $this->belongsTo('App\UserRegisterWithTeacher','lesson_id');
    }
}
