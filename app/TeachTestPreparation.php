<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeachTestPreparation extends Model
{
    protected $fillable = ['test', 'teacher_id'];
    public function teacher():BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }
}
