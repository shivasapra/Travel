<?php

namespace App\Http\Middleware;
use Session;
use Auth;
use Closure;

class Admin
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
        if(!Auth::user()->admin)
        {
            Session::flash('warning','you do not have permissions to perform this action');
            return redirect()->back();
        }
        return $next($request);
    }
}
