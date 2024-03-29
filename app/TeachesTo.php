<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachesTo extends Model
{      use SoftDeletes;
    protected $table = 'teaches_to';
    protected $fillable = ['teaches_to','teacher_id','from_age','to_age'];
    public function teacher():BelongsTo{
        return $this->belongsTo("App\Teacher");
    }
}
