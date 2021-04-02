<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckForAdmin
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
        if(!Auth::check()){
            return redirect()->route('login');
        }else{
            if(Auth::user()->role != 'admin'){
                flash("Unauthorized access")->error();
                return redirect()->route('main');
            }
        }
        return $next($request);
    }
}
