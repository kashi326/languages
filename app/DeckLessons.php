<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeckLessons extends Model
{    use SoftDeletes;

    public function decks():BelongsTo{
        return $this->belongsTo('App\Decks');
    }
}
