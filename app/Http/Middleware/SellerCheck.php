<?php

namespace App\Http\Middleware;

// use Auth;
use Closure;
use Illuminate\Support\Facades\Auth;

class SellerCheck
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
        if(Auth::guard('seller')->user()->parent_id !== null){
            abort(403);
        }
        return $next($request);
    }
}
