<?php

namespace App\Http\Controllers\Teach;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\Homework;
use Auth;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();
        $homework = Homework::LeftJoin('lessons as urt', 'urt.id', 'homework.lesson_id')
            ->LeftJoin('users', 'users.id', 'urt.user_id')
            ->where('urt.teacher_id', $teacher->id)->select('urt.*', 'users.*', 'homework.*', 'homework.id as homeworkID')->get();
        $data['homeworks'] = $homework;
        return view('teach.homework.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'homeworkFile' => 'required|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('homeworkFile')) {
            if ($request->file('homeworkFile')->isValid()) {
                $homework = new Homework;
                $File = $request->file('homeworkFile');
                $file_path =  $request->file('homeworkFile')->storeAs('/homework/homework_path/', time() . '.' . $File->getClientOriginalExtension());
                $homework->homework_path = $file_path;
                $homework->lesson_id = $request->lessonID;
                $homework->isChecked = 0;
                $homework->isExpired = null;
                $homework->marks = 0;
                $homework->remarks = '';
                $homework->save();
                return response()->view('includes.success_toast', ['color' => '#89b850', 'message' => 'Homework created successfully']);
            }
            return response()->view('includes.success_toast', ['color' => '#89b850', 'message' => 'Homework File is not of correct type successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function edit(Homework $homework)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hasFile('homeworkFile')) {
            if ($request->file('homeworkFile')->isValid()) {
                $homework = Homework::where('id', $request->homeworkID)->first();
                $request->validate([
                    'homeworkFile' => 'required|mimes:pdf|max:2048'
                ]);
                $oldhomework = $homework->homework_path;
                if (file_exists(public_path($oldhomework))) {
                    unlink(public_path($oldhomework));
                }
                $File = $request->file('homeworkFile');
                $file_path =  $request->file('homeworkFile')->storeAs('/homework/homework_path/', time() . '.' . $File->getClientOriginalExtension());
                $homework->homework_path = $file_path;
                $homework->update();
            }
            return response()->view('includes.success_toast', ['color' => '#89b850', 'message' => 'Homework Updated successfully']);
        }
        return response()->view('includes.success_toast', ['color' => '#dc3545', 'message' => 'File Submission Failed'], 500);
    }
    public function download($id)
    {
        $homework = Homework::where("id", $id)->first();

        $url = storage_path('app/' . $homework->response_path);

        $arr = explode('/', $url);
        $file_name = $arr[count($arr) - 1];
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($url, $file_name, $headers);
    }
    public function upload(Request $request)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        //
    }
}
