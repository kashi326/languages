<?php

namespace App\Http\Controllers;

use App\Homework;
use App\TeacherTiming;
use App\Traits\GetDates;
use App\UserRegisterWithTeacher;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LessonsController extends Controller
{
    use GetDates;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index($id)
    {
        $lesson = UserRegisterWithTeacher::with(["teacher" => function ($q) {
            $q->with('user');
        }], 'user', 'timing', 'homework')->where('id', $id)->first();
        $data['lesson'] = $lesson;
        return view('user.lessons.view', $data);
    }

    public function feedback(Request $request): JsonResponse
    {
        // dd($request);
        $request->validate([
            'feedback' => 'required|min:20|string'
        ]);
        $record = UserRegisterWithTeacher::where('id', $request->id)->first();
        $record->stars = $request->star;
        $record->feedback = $request->feedback;
        $record->update();
        return response()->json(['message' => 'Feedback Submitted successfully']);
    }

    public function download($id)
    {

        $homework = Homework::where("id", $id)->first();
        $url = storage_path('app/' . $homework->homework_path);

        $arr = explode('/', $url);
        $file_name = $arr[count($arr) - 1];
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($url, $file_name, $headers);
    }

    public function response(Request $request): Response
    {
        if ($request->hasFile('responseFile')) {
            if ($request->file('responseFile')->isValid()) {
                $homework = Homework::where('id', $request->homeworkID)->first();
                $request->validate([
                    'responseFile' => 'required|mimes:pdf|max:2048'
                ]);
                if (empty($homework->isExpired) || $homework->isExpired > date('Y-m-d H:i:s')) {
                    $oldhomework = $homework->response_path;
                    if ($oldhomework !== null && is_file(storage_path('app/' . $oldhomework))) {
                        unlink(storage_path('app/' . $oldhomework));
                    }
                    $File = $request->file('responseFile');
                    $file_path = $request->file('responseFile')->storeAs('homework/response_path', time() . '.' . $File->getClientOriginalExtension());
                    $homework->response_path = '/' . $file_path;
                    if ($homework->isExpired === null) {
                        $homework->isExpired = date('Y-m-d H:i:s');
                    }
                    $homework->update();
                    return response()->view('includes.success_toast', ['color' => '#89b850', 'message' => 'Homework Updated successfully']);
                } else {
                    return response()->view('includes.success_toast', ['color' => '#dc3545', 'message' => 'Time Expired'], 400);
                }
            }
        }
        return response()->view('includes.success_toast', ['color' => '#dc3545', 'message' => 'File Submission Failed'], 500);
    }



    public function update(Request $request, int $id): JsonResponse
    {
        $lesson = UserRegisterWithTeacher::find($id);
        if (UserRegisterWithTeacher::where("teacher_id", $request->teacher_id)->where('scheduled_date', $request->start)->where('id', '!=', $id)->exists()) {
            return response()->json(['error' => "Slot already booked"]);
        }
        $lesson->scheduled_date = $request->start;
        $lesson->timing_id = $request->timing_id;
        $lesson->save();
        return response()->json(['message' => "Class rescheduled, await teacher approval."]);
    }


    public function reschedule($id)
    {
        $lesson = UserRegisterWithTeacher::where("id", $id)->first();
        $allClasses = TeacherTiming::where('teacher_id', $lesson->teacher_id)->where('isOpen', 1)->select('name', 'open', 'close','id')->get();
        $dateFromString = date('Y-m-d');
        $dateToString = date('Y-m-d', strtotime(date("Y-m-d", time()) . " + 365 day"));
        $classes = [];
        foreach ($allClasses as $c) {
            $classes = array_merge($classes, $this->getRescheduleDates($dateFromString, $dateToString, $c->name, $c->open, $c->close, $c->id, $lesson));
        }

        return view('user.lessons.reschedule', compact('classes'));
    }
}
