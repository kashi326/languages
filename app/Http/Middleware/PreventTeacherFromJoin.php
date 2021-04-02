<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PreventTeacherFromJoin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == "teacher"){
            flash()->overlay("You have already created your profile. If you want to change go to the details section.");
            return redirect()->route('main');
        }
        return $next($request);
    }
}
