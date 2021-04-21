<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherTiming extends Model
{
    /**
     * @var mixed|string
     */

    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
