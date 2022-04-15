<?php

namespace App\Http\Controllers\Teach;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\User;
use App\UserRegisterWithTeacher;
use Illuminate\Http\Request;
use DB;
use Auth;

class LessonController extends Controller
{
    private $days = [
        'Sunday' => 0,
        'Monday' => 1,
        'Tuesday' => 2,
        'Wednesday' => 3,
        'Thursday' => 4,
        'Friday' => 5,
        'Saturday' => 6
    ];

    public function record(Request $request)
    {
        $lessonsList = DB::table('lessons as registered')
            ->LeftJoin('teacher_timings as timing', 'timing.id', '=', 'registered.timing_id')
            ->LeftJoin('users', 'users.id', '=', 'registered.user_id')
            ->LeftJoin('teachers', 'teachers.id', 'registered.teacher_id')
            ->where('teachers.user_id', Auth::id());
        if (isset($_GET['search'])) {
            $lessonsList = $lessonsList->where('users.name', 'LIKE', '%' . $_GET['search'] . '%');
        }

        if (isset($_GET['showBy'])) {
            $showBy = $_GET['showBy'];
            switch ($showBy) {
                case 'all':
                    break;
                case 'completed':
                    $lessonsList = $lessonsList->where('registered.isAttended', '=', 1);
                    break;
                case 'scheduled':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '>=', date('Y-m-d H:i:s'));
                    break;
                case 'incomplete':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '<', date('Y-m-d H:i:s'))->where('registered.isAttended', 0);
                    break;
            }
        }

        $lessonsList = $lessonsList->select('registered.*', 'timing.open', 'timing.close', 'users.name')->get();

        $teacher_id = Teacher::select('id')->where('user_id', Auth::id())->first();

        $lessonsDate = DB::table('lessons as urt')->where('urt.teacher_id', $teacher_id->id)->select('*')->get();

        $alllessons = [];
        foreach ($lessonsDate as  $ld) {
            foreach ($lessonsList as $ll) {
                if ($ld->created_at === $ll->created_at) {
                    $alllessons[$ld->created_at][] = $ll;
                }
            }
        }
        $lessons = [];
        foreach ($alllessons as $key => $l) {
            $array = array_map('json_encode', $l);
            $array = array_unique($array);
            $lessons[$key] = array_map('json_decode', $array);
        }

        $data = [];
        $data['lessons'] = array_reverse($lessons);
        if ($request->ajax()) {
            return response()->view('teach.lessonrecord.classesList', $data);
        }
        $data['html'] = view('teach.lessonrecord.classesList', $data);
        return view('teach.lessonrecord.index', $data);
    }

    public function view($id)
    {
        DB::connection()->enableQueryLog();
        $lesson = UserRegisterWithTeacher::with(['teacher' => function ($q) {
            return $q->with("user");
        }], 'user', 'timing', 'homework')->where("id", $id)->first();
        $data['lesson'] = $lesson;
        return view('teach.lessonrecord.view', $data);
    }
    public function platform(Request $request)
    {
        $request->validate([
            'platformName' => 'required|string',
            'lessonLink' => 'required'
        ]);

        $record = UserRegisterWithTeacher::where('id', $request->input('id'))->first();
        $record->platform = $request->platformName;
        $record->link = $request->lessonLink;
        $record->update();
        return response()->json(['message' => 'Platform Updated successfully']);
    }

}
