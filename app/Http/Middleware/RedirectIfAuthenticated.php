<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;

            case 'customer':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('customer.dashboard');
                }
                break;

            case 'seller':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('seller.dashboard');
                }
                break;

            case 'delivery':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('delivery.dashboard');
                }
                break;

            case 'affiliate':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('affiliate.dashboard');
                }
                break;

            case 'web':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('customer.dashboard');
                }
                break;

            default:
                //
        }

        return $next($request);
    }
}
