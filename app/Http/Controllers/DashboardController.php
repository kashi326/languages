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

        $other_langs = DB::table("user_speaks")
            ->where('user_id', Auth::id())
            ->leftjoin('languages', 'languages.id', '=', 'user_speaks.language_id')
            ->select('user_speaks.*', 'languages.*', 'user_speaks.id as speakID')->get();

        $lessonsList = DB::table('lessons as registered')
            ->LeftJoin('teacher_timings as timing', 'timing.id', '=', 'registered.timing_id')
            ->LeftJoin('teachers', 'teachers.id', '=', 'registered.teacher_id')
            ->where('registered.user_id', Auth::id());
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
        $lessonsDate = DB::table('lessons')->where('user_id', Auth::id())->select('created_at')->get();
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

        $lessonscount['attended'] = DB::table('lessons')->where('isAttended', 1)->where('user_id', Auth::id())->count();
        $lessonscount['past'] = DB::table('lessons')->where('scheduled_date', '<', date('yy-m-d H:i:s'))->where('user_id', Auth::id())->count();
        $lessonscount['upcoming'] = DB::table('lessons')->where('scheduled_date', '>=', date('yy-m-d H:i:s'))->where('user_id', Auth::id())->count();

        $favourite_teacher = DB::table('user_favourite_teacher as uft')
            ->LeftJoin('teachers', 'teachers.id', 'uft.teacher_id')
            ->LeftJoin('users', 'users.id', 'teachers.user_id')
            ->where('uft.user_id', Auth::id())
            ->select('teachers.id as teacher_id', 'users.avatar as avatar', 'teachers.name as teacher_name')->paginate(3);
        $classes = [];
        // dd($lessonsList);
        foreach ($lessonsList as $c) {
            $classes[] = [
                'title' => 'Class',
                'start' => date("Y-m-d H:i:s", strtotime($c->scheduled_date)),
                'end' => date("Y-m-d H:i:s", (strtotime($c->scheduled_date) + 800)),
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
        $data = [];
        $lessonsList = DB::table('lessons as registered')
            ->LeftJoin('teacher_timings as timing', 'timing.id', '=', 'registered.timing_id')
            ->LeftJoin('teachers', 'teachers.id', '=', 'registered.teacher_id')
            ->where('registered.user_id', Auth::id());
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
        $lessonsDate = DB::table('lessons')->where('user_id', Auth::id())->select('created_at')->get();
        // dd($lessonsList);
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
        $lessonscount['attended'] = DB::table('lessons')->where('isAttended', 1)->where('user_id', Auth::id())->count();
        $lessonscount['past'] = DB::table('lessons')->where('scheduled_date', '<', date('yy-m-d H:i:s'))->where('user_id', Auth::id())->count();
        $lessonscount['upcoming'] = DB::table('lessons')->where('scheduled_date', '>=', date('yy-m-d H:i:s'))->where('user_id', Auth::id())->count();


        $classes = [];
        foreach ($lessonsList as $c) {
            $classes[] = [
                'title' => 'Class',
                'start' => date("Y-m-d H:i:s", strtotime($c->scheduled_date)),
                'end' => date("Y-m-d H:i:s", (strtotime($c->scheduled_date) + 800)),
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
        }])->whereHas(['lessons' => function ($q) {
            $q->where("user_id", FacadesAuth::id());
        }])->get();
        // $my_teachers = DB::table('user_favourite_teacher as uft')
        //     ->LeftJoin('teachers', 'teachers.id', 'uft.teacher_id')
        //     ->LeftJoin('languages', 'languages.id', 'teachers.language_id')
        //     ->LeftJoin('users', 'users.id', 'teachers.user_id')
        //     ->where('uft.user_id', Auth::id())
        //     ->select('uft.teacher_id as teacher_id', 'teachers.name as teacher_name', 'teachers.country as teacher_country', 'languages.name as language_name', 'languages.code as language_code', 'users.avatar as teacher_avatar')
        //     ->union($teachers_registered_with)->get();
        return view('user.dashboard.myteachers')->with(['myteachers' => $teachers_registered_with]);
    }
    public function vocabulary()
    {
        return redirect()->back();
    }
}
