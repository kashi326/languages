<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\UserRegisterWithTeacher;
use App\UserVoteDiscussion;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DashboardController extends Controller
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
    public function index(Request $request)
    {
        $id = null;
        $user_id = "";
        if (auth()->user()->role != 'teacher') {
            $user_id = "user_id";
            $id = Auth::id();
        } else {
            $user_id = "teacher_id";
            $teacher = Teacher::where("user_id", Auth::id())->first();
            $id = $teacher->id;
        }

        $other_langs = DB::table("user_speaks")
            ->where('user_id', Auth::id())
            ->leftjoin('languages', 'languages.id', '=', 'user_speaks.language_id')
            ->select('user_speaks.*', 'languages.*', 'user_speaks.id as speakID')->get();

        $lessonsList = DB::table('lessons as registered')
            ->LeftJoin('teacher_timings as timing', 'timing.id', '=', 'registered.timing_id')
            ->LeftJoin('teachers', 'teachers.id', '=', 'registered.teacher_id')
            ->where("registered.$user_id", $id);
        if (isset($_GET['search'])) {
            $lessonsList = $lessonsList->where('teachers.name', 'LIKE', '%' . $_GET['search'] . '%');
        }
        if (isset($_GET['showBy'])) {
            $showBy = $_GET['showBy'];
            switch ($showBy) {
                case 'all':
                    break;
                case 'live':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '>', date('Y:m:d H:i:s'));
                    // dd($lessonsList);
                    break;

                case 'completed':
                    $lessonsList = $lessonsList->where('registered.isAttended', '=', 1);
                    break;

                case 'scheduled':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '>=', date('Y:m:d H:i:s'));
                    break;

                case 'incomplete':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '<', date('Y:m:d H:i:s'))->where('registered.isAttended', 0);
                    break;
            }
        }
        $lessonsList = $lessonsList->select('registered.*', 'timing.open', 'timing.close', 'teachers.name')->get();
        $lessonsDate = DB::table('lessons')->where("$user_id", $id)->select('created_at')->get();
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

        $lessonscount['attended'] = DB::table('lessons')->where('isAttended', 1)->where($user_id, $id)->count();
        $lessonscount['past'] = DB::table('lessons')->whereDate('scheduled_date', '<', Carbon::now())->where('isAttended', "!=", 1)->where($user_id, $id)->count();
        $lessonscount['upcoming'] = DB::table('lessons')->whereDate('scheduled_date', '>=', Carbon::now())->where($user_id, $id)->count();
        if (auth()->user()->role != 'teacher') {

            $favourite_teacher = DB::table('user_favourite_teacher as uft')
                ->LeftJoin('teachers', 'teachers.id', 'uft.teacher_id')
                ->LeftJoin('users', 'users.id', 'teachers.user_id')
                ->where('uft.user_id', Auth::id())
                ->select('teachers.id as teacher_id', 'users.avatar as avatar', 'teachers.name as teacher_name')->paginate(3);
        } else {
            $favourite_teacher = [];
        }
        $classes = [];
        foreach ($lessonsList as $c) {
            $classes[] = [
                'title' => 'Class',
                'start' => date("Y-m-d H:i:s", strtotime($c->scheduled_date)),
                'end' => Carbon::parse($c->scheduled_date)->addMinutes(60)->format('Y-m-d H:i:s'),
            ];
        }
        $data = [];
        $data['other_langs'] = $other_langs;
        $data['lessons'] = $lessons;
        $data['count'] = $lessonscount;
        $data['fav_teacher'] = $favourite_teacher;
        $data['classesTime'] = $classes;
        if ($request->ajax()) {
            return response()->view('user.dashboard.partials.list', $data);
        }
        $data['list'] = view('user.dashboard.partials.list', $data);
        return view('user.dashboard.dashboard', $data);
    }

    public function lessons(Request $request)
    {
        $id = null;
        $user_id = "";
        if (auth()->user()->role != 'teacher') {
            $user_id = "user_id";
            $id = Auth::id();
        } else {
            $user_id = "teacher_id";
            $teacher = Teacher::where("user_id", Auth::id())->first();
            $id = $teacher->id;
        }
        $data = [];
        $lessonsList = DB::table('lessons as registered')
            ->LeftJoin('teacher_timings as timing', 'timing.id', '=', 'registered.timing_id')
            ->LeftJoin('teachers', 'teachers.id', '=', 'registered.teacher_id')
            ->where("registered.$user_id", $id);
        if (isset($_GET['search'])) {
            $lessonsList = $lessonsList->where('teachers.name', 'LIKE', '%' . $_GET['search'] . '%');
        }
        if (isset($_GET['showBy'])) {
            $showBy = $_GET['showBy'];
            switch ($showBy) {
                case 'all':
                    break;
                case 'live':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '>', date('Y:m:d H:i:s'));
                    // dd($lessonsList);
                    break;

                case 'completed':
                    $lessonsList = $lessonsList->where('registered.isAttended', '=', 1);
                    break;

                case 'scheduled':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '>=', date('Y:m:d H:i:s'));
                    break;

                case 'incomplete':
                    $lessonsList = $lessonsList->where('registered.scheduled_date', '<', date('Y:m:d H:i:s'))->where('registered.isAttended', 0);
                    break;
            }
        }
        $lessonsList = $lessonsList->select('registered.*', 'timing.open', 'timing.close', 'teachers.name')->get();
        $lessonsDate = DB::table('lessons')->where($user_id, $id)->select('created_at')->get();
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
        $lessonscount['attended'] = DB::table('lessons')->where('isAttended', 1)->where($user_id, $id)->count();
        $lessonscount['past'] = DB::table('lessons')->where('scheduled_date', '<', date('yy-m-d H:i:s'))->where($user_id, $id)->count();
        $lessonscount['upcoming'] = DB::table('lessons')->where('scheduled_date', '>=', date('yy-m-d H:i:s'))->where($user_id, $id)->count();


        $classes = [];
        foreach ($lessonsList as $c) {
            $classes[] = [
                'title' => 'Class',
                'start' => date("Y-m-d H:i:s", strtotime($c->scheduled_date)),
                'end' => Carbon::parse($c->scheduled_date)->addMinutes(60)->format('Y-m-d H:i:s'),
            ];
        }

        $data = [];
        $data['lessons'] = $lessons;
        $data['count'] = $lessonscount;
        $data['classesTime'] = $classes;
        if ($request->ajax()) {
            return response()->view('user.dashboard.partials.list', $data);
        }
        $data['list'] = view('user.dashboard.partials.list', $data);
        return view('user.dashboard.lessons', $data);
    }
    public function homework()
    {
        return redirect()->back();
    }
    public function myteachers()
    {
        $teachers_registered_with = Teacher::withCount(['lessons' => function ($q) {
            return $q->where('user_id', FacadesAuth::id());
        }])->withCount(['lessons as attended' => function ($q) {
            return $q->where('isAttended', 1)->where('user_id', FacadesAuth::id());
        }])->withCount(['lessons as reschedule' => function ($q) {
            return $q->whereDate('scheduled_date', "<", Carbon::now())->where('isAttended', 0)->where('user_id', FacadesAuth::id());
        }])->withCount(['lessons as upcoming' => function ($q) {
            return $q->whereDate('scheduled_date', ">", Carbon::now())->where('isAttended', 0)->where('user_id', FacadesAuth::id());
        }])->leftJoin('lessons', 'lessons.teacher_id', 'teachers.id')->where('lessons.user_id', auth()->user()->id)->distinct('lesson.user_id')->get();
        return view('user.dashboard.myteachers')->with(['myteachers' => $teachers_registered_with]);
    }
    public function vocabulary()
    {
        return redirect()->back();
    }
}
