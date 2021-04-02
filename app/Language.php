<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function teachers(){
        return $this->hasMany("App\Teacher");
    }
    public function decks(){
        return $this->hasMany("App\Decks",'lang_to_id');
    }

    public function decks_in(){
        return $this->hasMany("App\Decks",'lang_in_id');
    }
}
