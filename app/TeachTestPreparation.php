<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachTestPreparation extends Model
{    use SoftDeletes;

    protected $fillable = ['test', 'teacher_id'];
    public function teacher():BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }
}
