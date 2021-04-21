<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeckLessons extends Model
{
    public function decks():BelongsTo{
        return $this->belongsTo('App\Decks');
    }
}
