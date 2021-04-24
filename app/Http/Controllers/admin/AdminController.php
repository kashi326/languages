<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\User;
use App\UserRegisterWithTeacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['teachers'] = Teacher::count();
        $data['students'] = User::where('role', 'user')->count();
        $data['latest_registration'] = User::whereDate('created_at', '>=', Carbon::now()->subDays(30))->count();
        $data['lessons_count'] = UserRegisterWithTeacher::count();
        $data['lessons'] = UserRegisterWithTeacher::orderBy('id', 'DESC')->limit(10)->get();

        return view('admin.index')->with($data);
    }
}
