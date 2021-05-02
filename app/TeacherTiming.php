<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherTiming extends Model
{    use SoftDeletes;

    /**
     * @var mixed|string
     */

    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
