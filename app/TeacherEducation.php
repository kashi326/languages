<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherEducation extends Model
{
    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
