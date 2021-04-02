<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PrivacyPolicy;
use App\SettingLessonInclude;
use App\SettingTeachingLevel;
use App\SettingTeachSubjects;
use App\SettingTeachTo;
use App\SettingTestPreparation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSubject()
    {
        $subjects = SettingTeachSubjects::get();
        return view('admin.setting.subject.index')->with('subjects', $subjects);
    }
    public function createSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $subject = new SettingTeachSubjects;
        $subject->subject = $request->subject;
        $subject->save();
        return response()->json(['message' => 'Subject Added Successfully']);
    }
    public function destroySubject(Request $request)
    {
        $subject = SettingTeachSubjects::destroy($request->ID);
        if ($subject)
            return response()->json(['message' => 'Deleted Successfully']);
    }

    public function getTestPreparation()
    {
        $test = SettingTestPreparation::get();
        return view('admin.setting.test.index')->with('tests', $test);
    }
    public function createTestPreparation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $test = new SettingTestPreparation;
        $test->test = $request->test;
        $test->save();
        return response()->json(['message' => 'Test Added Successfully']);
    }
    public function destroyTestPreparation(Request $request)
    {
        $test = SettingTestPreparation::destroy($request->ID);
        return response()->json(['message' => 'Test Deleted Successfully']);
    }
    public function getTeachesTo()
    {
        $to = SettingTeachTo::get();
        return view('admin.setting.teachesto.index')->with('tos', $to);
    }
    public function createTeachesTo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'age' => 'required|string',
            'fromAge' => 'required|numeric|min:0',
            'toAge' => 'required|numeric|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $alAge = SettingTeachTo::where('age', $request->age)->first();
        if ($alAge == null && $request->fromAge < $request->toAge) {
            $age = new SettingTeachTo;
            $age->age = $request->age;
            $age->from = $request->fromAge;
            $age->to = $request->toAge;
            $age->save();
            return response()->json(['message' => 'Age Added Successfully'], 201);
        } else {
            return response()->json(['message' => 'Age already exists'], 200);
        }
    }
    public function destroyTeachesTo(Request $request)
    {
        SettingTeachTo::destroy($request->ID);
        return response()->json(['message' => 'Age Deleted Successfully']);
    }
    public function getTeachingLevel()
    {
        $level = SettingTeachingLevel::get();
        return view('admin.setting.level.index')->with('levels', $level);

     }
    public function createTeachingLevel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $allevel = SettingTeachingLevel::where('level', $request->level)->first();
        if ($allevel == null) {
            $level = new SettingTeachingLevel;
            $level->level = $request->level;
            $level->save();
            return response()->json(['message' => 'Teaching Level Added Successfully'], 201);
        } else {
            return response()->json(['message' => 'Teaching Level already exists'], 200);
        }
    }
    public function destroyTeachingLevel(Request $request)
    {
        SettingTeachingLevel::destroy($request->ID);
        return response()->json(['message' => 'Teaching Level Deleted Successfully']);
    }
    public function getLessonInclude()
    {
        $include = SettingLessonInclude::get();
        return view('admin.setting.lessoninclude.index')->with('includes', $include);
    }
    public function createLessonInclude(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'include' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $alinclude = SettingLessonInclude::where('include', $request->include)->first();
        if ($alinclude == null) {
            $include = new SettingLessonInclude();
            $include->include = $request->include;
            $include->save();
            return response()->json(['message' => 'Record Added Successfully'], 201);
        } else {
            return response()->json(['message' => 'Record already exists'], 200);
        }
    }
    public function editLessonInclude($id, Request $request)
    {
        SettingLessonInclude::destroy($request->ID);
        return response()->json(['message' => 'Record Deleted Successfully']);
    }
    public function privacy(){
        $pp = PrivacyPolicy::get();
        return view('admin.privacy.edit',compact('pp'));
    }
    public function updateprivacy(Request $request){
        $id = $request->ID;
        $privacy = PrivacyPolicy::find($id);
        $privacy->heading = $request->heading;
        if($request->content){
            $privacy->content = strip_tags($request->content,'<p><a><ul><ol><li><hr><div>');
        }
        $privacy->update();
        return response()->json(['message'=>'Section Updated successfully']);
    }
    public function addprivacy(Request $request){
        $request->validate([
            'heading'=>'required'
        ]);
        $privacy = new PrivacyPolicy;
        $privacy->heading = $request->heading;
        if($request->content){
            $privacy->content = strip_tags($request->content,'<p><a><ul><ol><li><hr><div>');
        }
        $privacy->save();
        return response()->json(['message'=>'Section Added successfully']);
    }
    public function deleteprivacy(Request $request){
        $id = $request->ID;
        PrivacyPolicy::destroy($id);
        return response()->json(['message'=>'Section Deleted successfully']);

    }
}
