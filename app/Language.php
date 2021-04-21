<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    public function teachers():HasMany{
        return $this->hasMany("App\Teacher");
    }
    public function decks():HasMany{
        return $this->hasMany("App\Decks",'lang_to_id');
    }

    public function decks_in():HasMany{
        return $this->hasMany("App\Decks",'lang_in_id');
    }
}
