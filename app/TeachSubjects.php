<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachSubjects extends Model
{
    protected $fillable = ['subject', 'teacher_id'];
    public function teacher():BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }
}
