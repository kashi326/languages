<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decks extends Model
{
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
    public function language_to(){
        return $this->belongsTo("App\Language",'lang_to_id');
    }
    public function language_in(){
        return $this->belongsTo("App\Language",'lang_in_id');
    }
    public function deck_lessons(){
        return $this->hasMany('App\DeckLessons','deck_id');
    }
}
