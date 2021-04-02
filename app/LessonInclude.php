<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonInclude extends Model
{   protected $table= 'lesson_include';
    protected $fillable = ['includes','teacher_id'];
    public function teacher(){
        return $this->belongsTo("App\Teacher");
    }
}
