<?php

namespace App\Http\Controllers\Teach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Language;
use App\LessonInclude;
use Auth;
use App\Rules\DaysRule;
use App\Rules\OtherLangsRule;
use App\Teacher;
use App\TeacherTiming;
use App\OtherLangs;
use App\TeacherCertificates;
use App\TeacherEducation;
use App\TeacherExperience;
use App\TeachesTo;
use App\TeachingLevel;
use App\TeachSubjects;
use App\TeachTestPreparation;
use App\SettingLessonInclude;
use App\SettingTeachingLevel;
use App\SettingTeachSubjects;
use App\SettingTeachTo;
use App\SettingTestPreparation;
use App\Traits\GetDates;
use \Validator;
use DateTime;
use DateTimeZone;

class IndexController extends Controller
{
    use GetDates;
    public function join()
    {
        $langs = Language::select('id', 'name')->get();
        $user = Auth::user();
        return view('teach.join', compact('langs', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'details.phone' => "required",
            //            'details.gender' => "required",
            'details.primary_lang.name' => "required",
            'details.about' => "required",
            'details.agree' => "accepted",
            //            'details.country' => 'required',
            'days' => [new DaysRule],
            'other_langs' => [new OtherLangsRule]
        ]);

        $details = $request->details;
        $days = $request->days;
        $other_langs = $request->other_langs;
        $user = Auth::user();

        $teacher = new Teacher;
        $teacher->name = $user->name;
        $teacher->lastname = $user->lastname;
        $teacher->user_id = $user->id;
        $teacher->phone = $details['phone'];
        $teacher->gender = $user->gender;
        $teacher->language_id = $details['primary_lang']['id'];
        $teacher->about = $details['about'];
        $teacher->intro_link = $request->details['intro_link'];
        $teacher->country = $user->country;
        $teacher->save();

        foreach ($request->days as $key => $item) {
            $day = $item[0];
            $timing = new TeacherTiming;
            $timing->name = $key;
            if ($day['isOpen']) {
                if ($day['open'] == '24hrs' || $day['close'] == '24hrs') {
                    for ($i = 0; $i < 24; $i++) {
                        $timing2 = new TeacherTiming;
                        $timing2->name = $key;
                        $open = Carbon::today()->startOfDay()->addHour($i)->format('H:i');
                        $close = Carbon::today()->startOfDay()->addHour($i + 1)->format('H:i');
                        $timing2->open = $open;
                        $timing2->close = $close;
                        $timing2->isOpen = $day['isOpen'];
                        $teacher->timing()->save($timing2);
                    }
                } else {
                    $open = Carbon::createFromFormat("HiA", $day['open'])->format("H:i");
                    $close = Carbon::createFromFormat("HiA", $day['close'])->format("H:i");
                    $timing->open = $open;
                    $timing->close = $close;
                    $timing->isOpen = $day['isOpen'];
                    $teacher->timing()->save($timing);
                }
            }
        }

        foreach ($other_langs as $lang) {
            $other = new OtherLangs;
            $other->code = $lang['language']['code'];
            $other->name = $lang['language']['name'];
            $other->level = $lang['level']['name'];
            $teacher->other_langs()->save($other);
        }
        $user->role = "teacher";
        $user->save();
        // dd($user);
        return response()->json(['message' => "Profile created"]);
    }

    public function teachingProfile()
    {
        $teacher = Teacher::where('user_id', Auth::id())->with(['other_langs', 'language', 'teaching_level', 'lesson_include', 'teaches_to', 'teach_test_preparation', 'teach_subjects', 'teacher_education', 'teacher_experience', 'teacher_certificates'])->first();
        $allClasses = TeacherTiming::where('teacher_id', $teacher->id)->where('isOpen', 1)->select('name', 'open', 'close')->get();
        // $days = [
        //     'sunday' => 0,
        //     'monday' => 1,
        //     'tuesday' => 2,
        //     'wednesday' => 3,
        //     'thursday' => 4,
        //     'friday' => 5,
        //     'saturday' => 6
        // ];
        // $classes = [];
        // foreach ($allClasses as $c) {
        //     $classes[] = [
        //         'title' => 'Lesson ' . $c->id,
        //         'startTime' => $c->open,
        //         'endTime' => $c->close,
        //         'daysOfWeek' => [$days[$c->name]]
        //     ];
        // }
        $dateFromString = date('Y-m-d');
        $dateToString = date('Y-m-d', strtotime(date("Y-m-d", time()) . " + 365 day"));
        $classes = [];
        foreach ($allClasses as $c) {
            $classes = array_merge($classes, $this->getMondaysInRange($dateFromString, $dateToString, $c->name, $c->open, $c->close));
        }
        $data['teacher'] = $teacher;
        $data['classes'] = $classes;
        $data['setting_lessson_include'] = SettingLessonInclude::get();
        $data['setting_test_preparation'] = SettingTestPreparation::get();
        $data['setting_teach_to'] = SettingTeachTo::get();
        $data['setting_subjects'] = SettingTeachSubjects::get();
        $data['setting_level'] = SettingTeachingLevel::get();
        $data['languages'] = Language::get();
        return view('teach.profile.TeachingProfile', $data);
    }
    public function updateTeachingProfile(Request $request, $update)
    {
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        $teacher = Teacher::where("user_id", Auth::id())->first();
        switch ($update) {
            case 'introLink':
                $validator = Validator::make($request->all(), [
                    'intro_link' => 'required|url'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $teacher->intro_link = strip_tags($request->intro_link);
                $teacher->update();
                return response()->json(['message' => 'Introducation Link Updated Successfully'], 201);
                break;
            case 'AboutMe':
                // $request->validate([
                //     'aboutMe'=>'required'
                // ]);
                $validator = Validator::make($request->all(), [
                    'aboutMe' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $teacher->about = strip_tags($request->aboutMe, '<p><a><ul><ol><li><hr><div>');
                $teacher->update();
                return response()->json(['message' => $update . ' updated successfully'], 201);
                break;

            case 'teachesAdd':
                $validator = Validator::make($request->all(), [
                    'level' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $teacher_level = TeachingLevel::firstOrNew(
                    ['level' => $request->level, 'teacher_id' => $teacher->id],
                    ['teacher_id' => $teacher->id, 'level' => $request->level]
                );
                $teacher_level->save();
                return response()->json(['message' => 'Teaching Level Added Successfully'], 201);
                break;
            case 'teachesDelete':
                TeachingLevel::destroy($request->level);
                return response()->json(['message' => 'Teaching Level Deleted Successfully'], 202);
                break;
            case 'includeAdd':
                $validator = Validator::make($request->all(), [
                    'includes' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $teaching_include = LessonInclude::firstOrNew(
                    ['includes' => $request->includes, 'teacher_id' => $teacher->id],
                    ['teacher_id' => $teacher->id, 'includes' => $request->includes]
                );
                $teaching_include->save();

                return response()->json(['message' => 'Lesson Includes Added Successfully'], 201);
                break;
            case 'includeDelete':
                LessonInclude::destroy($request->include);
                return response()->json(['message' => 'Lesson Include Deleted Successfully'], 202);
                break;
            case 'teachesToAdd':
                $validator = Validator::make($request->all(), [
                    'teachesTo' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $to = SettingTeachTo::find($request->teachesTo);
                $teaches_to = TeachesTo::firstOrNew(
                    ['teaches_to' => $to->age, 'teacher_id' => $teacher->id],
                    ['teacher_id' => $teacher->id, 'teaches_to' => $to->age, 'from_age' => $to->from, 'to_age' => $to->to]
                );
                $teaches_to->save();
                return response()->json(['message' => 'Teaching To Added Successfully'], 201);
                break;
            case 'teachesToDelete':
                TeachesTo::destroy($request->teachesTo);
                return response()->json(['message' => 'Lesson Include Deleted Successfully'], 202);
                break;
            case 'subjectAdd':
                $validator = Validator::make($request->all(), [
                    'subject' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $teaching_subjects = TeachSubjects::firstOrNew(
                    ['subject' => $request->subject, 'teacher_id' => $teacher->id],
                    ['teacher_id' => $teacher->id, 'subject' => $request->subject]
                );
                $teaching_subjects->save();
                return response()->json(['message' => 'Subject Added Successfully'], 201);
                break;
            case 'subjectDelete':
                TeachSubjects::destroy($request->subject);
                return response()->json(['message' => 'Subject Deleted Successfully'], 202);
                break;
            case 'testPreparationAdd':
                $validator = Validator::make($request->all(), [
                    'test' => 'required'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $test_preparation = TeachTestPreparation::firstOrNew(
                    ['test' => $request->test, 'teacher_id' => $teacher->id],
                    ['teacher_id' => $teacher->id, 'test' => $request->test]
                );
                $test_preparation->save();
                return response()->json(['message' => 'Test Preparation Added Successfully'], 201);
                break;
            case 'testPreparationDelete':
                TeachTestPreparation::destroy($request->test);
                return response()->json(['message' => 'Subject Deleted Successfully'], 202);
                break;
            case 'educationAdd':
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'institute' => 'required',
                    'description' => 'required',
                    'from_year' => 'required|date',
                    'to_year' => 'required|date',
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $education = new TeacherEducation;
                $education->teacher_id = $teacher->id;
                $education->title =  strip_tags($request->title);
                $education->institute =  strip_tags($request->institute);
                $education->description =  strip_tags($request->description);
                $education->from_year = $request->from_year;
                $education->to_year = $request->to_year;
                $education->save();
                return response()->json(['message' => 'Education Added Successfully'], 201);
                break;
            case 'educationDelete':
                TeacherEducation::destroy($request->educationID);
                return response()->json(['message' => 'Education Deleted Successfully'], 202);
                break;
            case 'experienceAdd':
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'institute' => 'required',
                    'description' => 'required',
                    'from_year' => 'required|date',
                    'to_year' => 'required|date',
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $experience = new TeacherExperience;
                $experience->teacher_id = $teacher->id;
                $experience->title =  strip_tags($request->title);
                $experience->institute =  strip_tags($request->institute);
                $experience->description =  strip_tags($request->description);
                $experience->from_year = $request->from_year;
                $experience->to_year = $request->to_year;
                $experience->save();
                return response()->json(['message' => 'Experience Added Successfully'], 201);
                break;
            case 'experienceDelete':
                TeacherExperience::destroy($request->experienceID);
                return response()->json(['message' => 'Experience Deleted Successfully'], 202);
                break;
            case 'certificatesAdd':
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'institute' => 'required',
                    'description' => 'required',
                    'from_year' => 'required|date',
                    'to_year' => 'required|date',
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $certificates = new TeacherCertificates;
                $certificates->teacher_id = $teacher->id;
                $certificates->title =  strip_tags($request->title);
                $certificates->institute =  strip_tags($request->institute);
                $certificates->description =  strip_tags($request->description);
                $certificates->from_year = $request->from_year;
                $certificates->to_year = $request->to_year;
                $certificates->save();
                return response()->json(['message' => 'Experience Added Successfully'], 201);
                break;
            case 'certificatesDelete':
                TeacherCertificates::destroy($request->certificatesID);
                return response()->json(['message' => 'Experience Deleted Successfully'], 202);
                break;
            case 'price':
                $validator = Validator::make($request->all(), [
                    'lessonPrice' => 'required|numeric|min:0',
                    'discount' => 'required|numeric|min:0|max:100',
                    'trail_price' => 'required|numeric|min:0'
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $teacher->price = $request->lessonPrice;
                $teacher->discount = $request->discount;
                $teacher->trail = $request->has('trail') && $request->trail == 'on';
                $teacher->trail_price = $request->has('trail_price') ? $request->trail_price : 0.01;
                $teacher->update();
                return response()->json(['message' => 'Price & Discount updated Successfully'], 208);
                break;
            case 'accentAdd':
                $validator = Validator::make($request->all(), [
                    'lang' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['message' => $validator->errors()], 401);
                }
                $other_langs = new OtherLangs;
                $other_langs->name = $request->lang;
                $other_langs->code = $request->lang;
                $other_langs->level = "Intermediate";
                $other_langs->teacher_id = $teacher->id;
                $other_langs->save();
                return response()->json(['message' => 'Accent added'], 201);
                break;
            case 'accentDelete':
                OtherLangs::destroy($request->lang);
                return response()->json(['message' => 'Accent Deleted Successfully'], 202);
                break;
        }
    }
    public function addTiming(Request $request)
    {
        $start_class = new DateTime($request->start, new DateTimeZone('UTC'));
        $end_class = new DateTime($request->end, new DateTimeZone('UTC'));
        $timing = new TeacherTiming;
        $timing->name = strtolower($start_class->format('l'));
        $timing->open = $start_class->format('H:i:s');
        $timing->close = Carbon::parse($start_class)->addMinutes(60)->format('H:i:s');
        $timing->isOpen = 1;
        $timing->teacher_id = $request->teacher_id;
        try {
            $timing->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);
        }
        return response()->json('Timing added successfully');
    }
    public function deleteTiming(Request $request)
    {
        $start_class = new DateTime($request->start, new DateTimeZone('UTC'));
        $end_class = new DateTime($request->end, new DateTimeZone('UTC'));
        $timing = null;
        try {
            $timing = TeacherTiming::where('name', strtolower($start_class->format('l')))->where('open', $start_class->format('H:i:s'))->where('close', $end_class->format('H:i:s'))->where('teacher_id', $request->teacher_id)->first();
            $timing->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);
        }
        return response()->json($timing);
    }

    public function batchAddTiming(Request $request)
    {
        $request->validate([
            'day' => 'required|array',
            'to' => 'required|array',
            'from' => 'required|array',
        ]);
        $teacher = Teacher::where('user_id', auth()->user()->id)->first();
        foreach ($request->day as $key => $day) {
            $start  = Carbon::parse($request->from[$key]);
            $end  = Carbon::parse($request->to[$key]);
            while ($start <= $end) {
                $startBeforeAdd = $start->format('H:i:s');
                $startAddUp = $start->addMinutes('60')->format("H:i:s");
                $teacher_timing = TeacherTiming::whereTime('open', '>=', $startBeforeAdd)->whereTime("close", "<=", $startAddUp)->where('teacher_id', $teacher->id)->where('name', $day)->first();
                if ($teacher_timing) continue;
                $time = new TeacherTiming();
                $time->name = strtolower($day);;
                $time->isOpen = 1;
                $time->open = $startBeforeAdd;
                $time->close = $startAddUp;
                $time->teacher_id = $teacher->id;
                $time->save();
            }
        }
        return redirect()->back();
    }
}
