<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeckLessons extends Model
{
    public function decks(){
        return $this->belongsTo('App\Decks');
    }
}
