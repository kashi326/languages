<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachSubjects extends Model
{
    protected $fillable = ['subject', 'teacher_id'];
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
