<?php

namespace App\Http\Middleware;

// use Auth;
use Closure;
use Illuminate\Support\Facades\Auth;

class LogRoles
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
        if(Auth::guard('admin')->user()->id !== 1){
            abort(403);
        }
        return $next($request);
    }
}
