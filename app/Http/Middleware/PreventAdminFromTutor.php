<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PreventAdminFromTutor
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
        if(Auth::user()->role == 'admin'){
            flash()->overlay("You are an admin and can't join as tutor.","Alert",);
            return redirect()->route('main');
        }
        // if(Auth::user()->role == 'user'){
        //     flash()->overlay("Permission denied","Alert",);
        //     return redirect()->route('main');
        // }
        return $next($request);
    }
}
