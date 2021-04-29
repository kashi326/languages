<?php

namespace App\Http\Controllers;

use App\Traits\GetDates;
use App\User;
use Illuminate\Http\Request;
use App\Teacher;
use App\Language;
use App\TeacherTiming;
use App\UserRegisterWithTeacher;
use DB;

class FindTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use GetDates;

    public function index()
    {
        DB::enableQueryLog();
        $teachers = Teacher::
            LeftJoin('users', 'users.id', '=', 'teachers.user_id')
            ->LeftJoin('languages', 'languages.id', '=', 'teachers.language_id')
            ->leftJoin('lessons', 'lessons.teacher_id', '=', 'teachers.id')
//            ->distinct()
            ->select(
                'teachers.name as teachername',
                'users.*',
                'languages.name as languagename',
                'teachers.id as teacherid',
                'teachers.country',
                'teachers.verified as isVerified',
                'teachers.about',
                'teachers.updated_at as lastupdated',
                'teachers.intro_link as intro'
            )->withCount('lessons');
        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
            $teachers = $teachers->where('languages.name', $lang);
        }
        if (isset($_GET['teacherSpeaks'])) {
            $speaks = $_GET['teacherSpeaks'];
            foreach ($speaks as $speak)
                $teachers = $teachers->where('other_langs.name', $speak)->where('other_langs.teacher_id', 'teachers.id');
        }
        if (isset($_GET['from'])) {
            $fromCountry = $_GET['from'];
            $teachers = $teachers->where('teachers.country', $fromCountry);
        }
        if (isset($_GET['userSelected'])) {
            $userSelected = $_GET['userSelected'];
            $teachers = $teachers->where('teachers.language_id', $userSelected);
        }
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $teachers = $teachers->where('teachers.name', 'like', "%$search%")->orWhere('teachers.lastname', 'like', "%$search%");
        }
        $teachers = $teachers->paginate(10);
        $langs = DB::table('languages')->select('name')->get();
        $data['teachers'] = $teachers;
        $data['langs'] = $langs;
        $data['countries'] = Teacher::select('country')->distinct()->get();
        return view('user.findteacher', $data);
    }

    public function profile($id, $name)
    {
        //get teacher with particular id
        $teacher = DB::table('teachers')
            ->where('teachers.id', $id)
            ->LeftJoin('users', 'users.id', '=', 'teachers.user_id')
            ->select("teachers.*", 'users.avatar')
            ->get();
        $teacher = $teacher[0];

        $teacher_resume = Teacher::with('teacher_education', 'teacher_experience', 'teacher_certificates')->withCount('lessons')->where('id', $id)->first();

        $expertise = Teacher::where('id', $id)->with(['other_langs', 'language', 'teaching_level', 'lesson_include', 'teaches_to', 'teach_test_preparation', 'teach_subjects', 'teacher_education'])->first();

        $stars = UserRegisterWithTeacher::where('teacher_id', $id)->where('isAttended', 1)->avg("stars");

        $comments = DB::table("lessons as urt")
            ->LeftJoin("users as u", 'u.id', 'urt.user_id')
            ->where('urt.teacher_id', $id)
            ->where('isAttended', 1)
            ->paginate(2);
        $rating = $stars;
        $HTML = "";
        if ($rating != 0 || $rating != null) {
            $wholeStars = floor($rating);
            $halfStar = round($rating * 2) % 2;

            for ($i = 0; $i < $wholeStars; $i++) {
                $HTML .= "<img src='/icons/star.svg' alt='Star' width='20px' height='20px'> ";
            }
            if ($halfStar) {
                $HTML .= "<img src='/icons/halfrating.svg' alt='Star' width='20px' height='20px'> ";
            }
        } else {
            $rating = 0;
        }
        $allClasses = TeacherTiming::where('teacher_id', $id)->where('isOpen', 1)->select('name', 'open', 'close')->get();
        $dateFromString = date('Y-m-d');
        $dateToString = date('Y-m-d', strtotime(date("Y-m-d", time()) . " + 365 day"));
        $classes = [];
        foreach ($allClasses as $c) {
            $classes = array_merge($classes, $this->getMondaysInRange($dateFromString, $dateToString, $c->name, $c->open, $c->close, $id));
        }
        $total_registered_lessons = UserRegisterWithTeacher::where('teacher_id', $id)->get();
        $lesson_per_Student = UserRegisterWithTeacher::where('teacher_id', $id)->groupBy('user_id')->select('user_id')->get();
        $data = [];
        $data['teacher'] = $teacher;
        $data['resume'] = $teacher_resume;
        $data['rating'] = $HTML;
        $data['ratingCount'] = $rating;
        $data['comments'] = $comments;
        $data['classes'] = $classes;
        $data['expertise'] = $expertise;
        $data['total_registered_lessons'] = count($total_registered_lessons);
        $data['lesson_per_Student'] = count($lesson_per_Student);
        return view('user.vteacherprofile', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
