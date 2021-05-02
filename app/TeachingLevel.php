<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachingLevel extends Model
{     use SoftDeletes;
    protected $table = 'teaching_level';
    protected $fillable = ['level','teacher_id'];
    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
