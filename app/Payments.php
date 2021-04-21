<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payments extends Model
{
    public function teacher():BelongsTo{
        return $this->belongsTo('App\Teacher');
    }
    public function user():BelongsTo{
        return $this->belongsTo('App\User');
    }
}
