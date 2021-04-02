<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App;

class WelcomeController extends Controller
{
    public function index(){
        $langs = DB::table("languages")->limit(7)->get();
        return view('welcome',compact('langs'));
    }
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
