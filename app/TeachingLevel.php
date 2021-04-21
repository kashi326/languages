<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachingLevel extends Model
{   protected $table = 'teaching_level';
    protected $fillable = ['level','teacher_id'];
    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
