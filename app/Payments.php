<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use SoftDeletes;

    protected $casts = ['created_at' => 'date:Y-m-d'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
