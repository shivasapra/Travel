<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;

class ImpersonateMiddleware
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
        // if(Request::session()->has('impersonated'))
        // {
        //     Auth::onceUsingId(Request::session()->get('impersonated'));
        //     }
        return $next($request);
    }
}
