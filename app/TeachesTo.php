<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachesTo extends Model
{   protected $table = 'teaches_to';
    protected $fillable = ['teaches_to','teacher_id','from_age','to_age'];
    public function teacher(){
        return $this->belongsTo("App\Teacher");
    }
}
