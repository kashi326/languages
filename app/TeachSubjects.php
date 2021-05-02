<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachSubjects extends Model
{    use SoftDeletes;

    protected $fillable = ['subject', 'teacher_id'];
    public function teacher():BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }
}
