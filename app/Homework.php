<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Homework extends Model
{    use SoftDeletes;

    public function lesson():BelongsTo{
        return $this->belongsTo('App\UserRegisterWithTeacher','lesson_id');
    }
}
