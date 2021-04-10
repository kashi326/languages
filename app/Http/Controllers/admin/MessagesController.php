<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Messages::select('session_id')->distinct()->get();
    }
    public function show($session_id)
    {
        $users = Messages::select('user_id')->where('session_id', $session_id)->distinct()->limit(2)->get();
        $messages = Messages::where('session_id', $session_id)->get();
        return view('admin.meeting.index', compact('messages', 'users'));
    }
}
