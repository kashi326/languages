<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRegisterWithTeacher extends Model
{    use SoftDeletes;

    protected $table = 'lessons';
    public function teacher():BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo('App\User');
    }
    public function timing():BelongsTo
    {
        return $this->belongsTo('App\TeacherTiming');
    }
    public function homework():HasOne{
        return $this->hasOne('App\Homework','lesson_id');
    }
}
