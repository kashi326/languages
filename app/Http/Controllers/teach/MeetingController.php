<?php

namespace App\Http\Controllers\teach;

use App\Http\Controllers\Controller;
use App\UserRegisterWithTeacher;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index($id, $teacher_id)
    {
        $lesson = UserRegisterWithTeacher::where('id', $id)->where('teacher_id', $teacher_id)->get();
        if ($lesson && $lesson->platform && $lesson->link) {
            redirect(route('meeting.start', $lesson->link));
        } else if ($lesson) {
            $lesson->platform = env('APP_NAME', "Languages");
            $lesson->link = Uuid::generate(8)->string;
            $lesson->save();
            redirect(route('meeting.start', $lesson->link));
        } else
            return redirect()->back();
    }
}
