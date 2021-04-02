<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachTestPreparation extends Model
{
    protected $fillable = ['test', 'teacher_id'];
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
