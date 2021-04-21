<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonInclude extends Model
{   protected $table= 'lesson_include';
    protected $fillable = ['includes','teacher_id'];
    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
