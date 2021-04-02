<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherLangs extends Model
{
    public function teacher(){
        return $this->belongsTo("App\Teacher");
    }
}
