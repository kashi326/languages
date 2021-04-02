<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachingLevel extends Model
{   protected $table = 'teaching_level';
    protected $fillable = ['level','teacher_id'];
    public function teacher(){
        return $this->belongsTo("App\Teacher");
    }
}
