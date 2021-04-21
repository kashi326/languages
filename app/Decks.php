<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Decks extends Model
{
    public function teacher(): BelongsTo
    {
        return $this->belongsTo('App\Teacher');
    }
    public function language_to():BelongsTo
{
        return $this->belongsTo("App\Language",'lang_to_id');
    }
    public function language_in():BelongsTo
    {
        return $this->belongsTo("App\Language",'lang_in_id');
    }
    public function deck_lessons():HasMany
    {
        return $this->hasMany('App\DeckLessons','deck_id');
    }
}
