<?php

namespace App\Http\Controllers;

use App\UserRegisterWithTeacher;
use Illuminate\Support\Str;

class MeetingController extends Controller
{
    public function index($id, $userid)
    {
        return view('user.meeting.index', compact('id', 'userid'));
    }
    public function start($id, $userid)
    {
        $lesson = UserRegisterWithTeacher::where('id', $id)->first();
        if ($lesson && $lesson->platform && $lesson->link) {
            return redirect()->route('meeting.start', [$lesson->link, $userid]);
        } else if ($lesson) {
            $lesson->platform = env('APP_NAME', "Languages");
            $lesson->link = (string)Str::uuid();
            $lesson->save();
            return redirect()->route('meeting.start', [$lesson->link, $userid]);
        } else
            return redirect()->back();
    }
}
