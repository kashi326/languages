<?php

namespace App\Http\Controllers\Admin;

use App\Homework;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Teacher;
use App\Language;
use App\TeacherTiming;
use App\OtherLangs;
use App\UserRegisterWithTeacher;
use Facade\FlareClient\View;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers =  Teacher::paginate(10);
        return view('admin.teacher.index', compact('teachers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Teacher $teacher)
    {
        $languages = Language::all();
        $teacher_timing = TeacherTiming::where('teacher_id', $teacher->id)->get();
        return view('admin.teacher.show', compact('teacher', 'languages', 'teacher_timing'));
    }


    public function edit(Teacher $teacher)
    {
        //
    }


    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'      => "required",
            'gender'    => "required",
            'phone'     => "required",
            'status'    => "required"
        ]);
        if($request->has('isOpen')){
            foreach ($request->isOpen as $key => $id) {
                $data = array(
                    'isOpen'    => $request->isOpen[$key],
                    'open'      => $request->open[$key],
                    'close'     => $request->close[$key],
                );
                TeacherTiming::where('id', $request->id)->update($data);
            }
        }

        if ($request->other_language) {

            foreach ($request->other_language as $key => $id) {
                $other_language = new OtherLangs();
                $other_language->teacher_id = $request->teacher_id;
                $other_language->code = $request->other_language[$key];
                $other_language->name = $request->other_language[$key];
                $other_language->level = $request->level[$key];
                $other_language->save();
            }
        }


        $teacher->name = $request->name;
        $teacher->lastname = $request->lastname;
        $teacher->language_id = $request->language_id;
        $teacher->gender = $request->gender;
        $teacher->phone = $request->phone;
        $teacher->status = $request->status;
        $teacher->save();
        flash("Details updated")->warning();
        return redirect()->back();
    }


    public function destroy(Teacher $teacher)
    {
        $teacher->timing()->delete();
        $teacher->other_langs()->delete();
        $teacher->user()->update([
            'role' => 'user'
        ]);
        $teacher->delete();
        flash("Teacher Deleted")->error();
        return redirect()->back();
    }

    public function lesson()
    {
        $lessons = UserRegisterWithTeacher::with('teacher', 'user', 'timing')->paginate(10);
        return view('admin.lessons.index')->with(['lessons' => $lessons]);
    }
    public function lessonView(UserRegisterWithTeacher $lesson)
    {
        $lessonData = UserRegisterWithTeacher::where('id', $lesson->id)->with('teacher', 'user', 'timing')->first();
        return view('admin.lessons.view')->with('lesson', $lessonData);
    }
    public function homework()
    {
        $homework = Homework::with(['lesson' => function ($q) {
            return $q->with('teacher', 'user');
        }])->paginate(10);
        return view('admin.homework.index')->with('homeworks', $homework);
    }
    public function download($type, $id, Request $request)
    {
       $homework = Homework::where("id",$id)->first();
        $url = '';
        if ($type == 'homework') {
            $url = public_path($homework->homework_path);
        } else if ($type == 'response') {
            $url = public_path($homework->response_path);
        }
        $arr = explode('/', $url);
        $file_name = $arr[count($arr) - 1];
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($url, $file_name, $headers);
    }
}
