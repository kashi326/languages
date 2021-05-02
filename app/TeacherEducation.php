<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherEducation extends Model
{    use SoftDeletes;

    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
