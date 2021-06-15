<?php

namespace App\Http\Controllers;

use App\Payments;
use App\Teacher;
use App\User;
use App\UserSpeak;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {

        $HTML = view('user.settings.profile');
        if ($request->ajax()) {
            return response()->view('user.settings.profile');
        }
        return view('user.settings.general')->with('html', $HTML);
    }

    public function updateProfile(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'country'=>'required',
            'gender'=>'required'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->phone =$request->input('phone');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->gender = $request->input('gender');
        Auth::user()->email !== $request->input('email') ? $user->email_verified_at = null : '';
        $user->update();
        return response()->json(['message' => 'Profile updated successfully']);
    }
    public function getProfilePicture(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        return response()->view('user.settings.profilepicture');
    }
    public function updateProfilePicture(Request $request)
    {
        if(!$request->ajax()){
            abort(403);
            exit;
        }
        if ($request->hasFile('profilepic')) {
            if ($request->file('profilepic')->isValid()) {
                $rules = [
                    'profilepic' => 'mimes:jpeg,png|max:2048',
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                $oldpicture = Auth::user()->avatar;
                if(file_exists(public_path($oldpicture))){
                    try {
                        unlink(public_path($oldpicture));
                    }catch(\Exception $e){

                    }
                }
                $image = $request->file('profilepic');
                $name = trim($image->getClientOriginalName());
                $image->move(public_path().'/profilepicture/',$name);
                $image_path = 'profilepicture/'.$name;

                $user = User::find(Auth::id());
                $user->avatar = $image_path;
                $user->update();
                Auth::user()->fresh()->avatar;
            }
            return response()->json(['message' => 'Profile Updated successfully','profilePicture'=>'<img src="'.asset($image_path).'" alt="" width="200" height="200" >']);
        }
        return response()->json(['message' => 'Either the File was not an image or size exceed our limit (2MB)'], 500);
    }

    public function getLanguages(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        $other_langs = DB::table("user_speaks")
            ->where('user_id', Auth::id())
            ->leftjoin('languages', 'languages.id', '=', 'user_speaks.language_id')
            ->select('user_speaks.*', 'languages.*','user_speaks.id as speakID')->get();
        return response()->view('user.settings.languages',compact('other_langs'));
    }
    public function deletelanguage($id){
        UserSpeak::where('id',$id)->delete();
        return response()->json('Delete successfully '.$id,200);
    }
    public function updateLevel(Request $request)
    {
        $lang = UserSpeak::find($request->id);
        $lang->level = $request->level;
        $lang->update();
        return response()->json("Level Updated",200);
    }
    public function updateMotivation(Request $request)
    {
        $lang = UserSpeak::find($request->id);
        $lang->motivation = $request->motivation;
        $lang->update();
        return response()->json("Motivation Updated",200);

    }
    public function getPassword(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        return response()->view('user.settings.password');
    }
    public function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8',
        ]);
            if($validator->fails()){
                return response()->json(['message' => $validator->errors()], 401);
            }
        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('newPassword');
        $confirmPassword = $request->input('confirmPassword');
        if (Hash::check($currentPassword, Auth::user()->password)) {
            if ($newPassword === $confirmPassword) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($newPassword);
                $user->update();
                return response()->json(['message' => 'Password Updated successfully']);
            } else {
                return response()->json(['message' => 'Password New Password Fields doesn\'t match'], 500);
            }
        } else {
            return response()->json(['message' => $newPassword, 'message2' => $confirmPassword, 'message3' => $currentPassword], 500);
        }
    }
    public function getPayments(Request $request){
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        // if(Auth::user()->role == 'admin'){
        //     return response()->view('includes.notfound');
        // }else
        if(Auth::user()->role == 'user' || Auth::user()->role == 'admin'){
            $payments = Payments::where('user_id',Auth::user()->id)->with('teacher','user')->get();
        }else{
            $teacher = Teacher::where('user_id',Auth::id())->first();
            $payments = Payments::where('teacher_id',$teacher->id)->with('teacher','user')->get();
        }
        return response()->view('user.settings.payments',compact('payments'));
    }
    public function getNotification()
    { }
    public function updateNotification()
    { }
    public function getUser(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
            exit;
        }
        return response()->view("user.settings.user");
    }
    public function destroyUser(Request $request)
    {
        // if (!$request->ajax()) {
        //     abort(403);
        //     exit;
        // }
        // dd('hello');
        // $request->validate([
        //     'currentPassword' => 'required',
        // ]);
        // echo  $request->input('currentPassword');
        $currentPassword = $request->input('currentPassword');
        if (Hash::check($currentPassword, Auth::user()->password)) {
            $user = User::destroy(Auth::id());
            Auth::logout();
            return response()->json(['message' => 'Accounted deleted successfully'],202);
        } else {
            return response()->json(['message' => 'Password does not match out record. Please Enter Current password'], 500);
        }
    }
    public function addSpeak(Request $request){
        $validator = Validator::make($request->all(), [
            'UserSpeak' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 401);
        }
        $speak = new UserSpeak;
        $speak->language_id = $request->UserSpeak;
        $speak->user_id = Auth::id();
        $speak->level = $request->level;
        $speak->motivation = $request->motivation;
        $speak->save();
        return response()->json(['message' => 'Language added'], 201);
    }
}
