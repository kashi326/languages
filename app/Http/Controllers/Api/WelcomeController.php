<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Language;
use App\Notification;

class WelcomeController extends Controller
{
    public function index(){
        $langs = Language::select('id','name','avatar')->get();
        foreach($langs as $lang){
        	$lang->avatar = asset("storage/lang_images/".$lang->avatar);
        }
        return response()->json(['langs'=>$langs]);
    }
    public function notifications($id){
        $notifications = Notification::where('notifiable_id',$id)->where('read_at',null)->select('data')->limit(6)->orderBy('created_at','desc')->get();
        return response()->json($notifications);
    }
}
