<?php

namespace App\Http\Controllers;

use App\UserRegisterWithTeacher;
use Illuminate\Support\Str;

class MeetingController extends Controller
{
    public function index($id)
    {
        $userid = Auth::id();
        return view('user.meeting.index', compact('id', 'userid'));
    }
    public function start($id, $userid)
    {
        $lesson = UserRegisterWithTeacher::where('id', $id)->first();
        if ($lesson && $lesson->platform && $lesson->link) {
            return redirect()->to($lesson->link);
        } else if ($lesson) {
            $session_id = (string)Str::uuid();
            $lesson->platform = env('APP_NAME', "Languages");
            $lesson->session_id = $session_id;
            $lesson->link = route('meeting.start', [$session_id, $userid]);
            $lesson->isAttended = 1;
            $lesson->save();
            return redirect()->to($lesson->link);
        } else
            return redirect()->back();
    }
}
