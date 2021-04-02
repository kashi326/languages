<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function language(){
        return $this->belongsTo("App\Language");
    }
    public function timing(){
        return $this->hasMany("App\TeacherTiming");
    }
    public function other_langs(){
        return $this->hasMany("App\OtherLangs");
    }
    public function teaching_level(){
        return $this->hasMany('App\TeachingLevel');
    }
    public function lesson_include(){
        return $this->hasMany('App\LessonInclude');
    }
    public function teaches_to(){
        return $this->hasMany('App\TeachesTo');
    }
    public function teach_test_preparation(){
        return $this->hasMany('App\TeachTestPreparation');
    }
    public function teach_subjects(){
        return $this->hasMany('App\TeachSubjects');
    }
    public function teacher_education(){
        return $this->hasMany('App\TeacherEducation');
    }
    public function teacher_experience(){
        return $this->hasMany('App\TeacherExperience');
    }
    public function teacher_certificates(){
        return $this->hasMany('App\TeacherCertificates');
    }
    public function lessons(){
        return $this->hasMany("App\UserRegisterWithTeacher");
    }
    public function decks(){
        return $this->hasMany("App\Decks");
    }
    public function user(){
        return $this->belongsTo("App\User")->withTrashed();
    }
    public function payments(){
        return $this->hasMany("App\Payment");
    }
}

