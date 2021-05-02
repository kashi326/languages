<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    public function language():BelongsTo{
        return $this->belongsTo("App\Language");
    }
    public function timing():HasMany{
        return $this->hasMany("App\TeacherTiming");
    }
    public function other_langs():HasMany{
        return $this->hasMany("App\OtherLangs");
    }
    public function teaching_level():HasMany{
        return $this->hasMany('App\TeachingLevel');
    }
    public function lesson_include():HasMany{
        return $this->hasMany('App\LessonInclude');
    }
    public function teaches_to():HasMany{
        return $this->hasMany('App\TeachesTo');
    }
    public function teach_test_preparation():HasMany{
        return $this->hasMany('App\TeachTestPreparation');
    }
    public function teach_subjects():HasMany{
        return $this->hasMany('App\TeachSubjects');
    }
    public function teacher_education():HasMany{
        return $this->hasMany('App\TeacherEducation');
    }
    public function teacher_experience():HasMany{
        return $this->hasMany('App\TeacherExperience');
    }
    public function teacher_certificates():HasMany{
        return $this->hasMany('App\TeacherCertificates');
    }
    public function lessons():HasMany{
        return $this->hasMany("App\UserRegisterWithTeacher");
    }
    public function decks():HasMany{
        return $this->hasMany("App\Decks");
    }
    public function user():BelongsTo{
        return $this->belongsTo("App\User")->withTrashed();
    }
    public function payments():HasMany{
        return $this->hasMany("App\Payment");
    }

}

