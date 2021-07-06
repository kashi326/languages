<?php

namespace App\Http\Controllers\teach;

use App\Http\Controllers\Controller;
use App\Notifications\ClassStarted;
use App\UserRegisterWithTeacher;
use Illuminate\Support\Str;

class MeetingController extends Controller
{
    public function index($id, $teacher_id)
    {
        $lesson = UserRegisterWithTeacher::where('id', $id)->first();
        if ($lesson && $lesson->platform && $lesson->link) {
            $lesson->teacher->user->notify(new ClassStarted($lesson));
            return redirect()->to($lesson->link);
        } else if ($lesson) {
            $lesson->teacher->user->notify(new ClassStarted($lesson));
            $session_id = (string)Str::uuid();
            $lesson->platform = env('APP_NAME', "Languages");
            $lesson->session_id = $session_id;
            $lesson->link = route('meeting.start', [$session_id, $teacher_id]);
            $lesson->isAttended = 1;
            $lesson->save();
            return redirect()->to($lesson->link);
        } else
            return redirect()->back();
    }
}
