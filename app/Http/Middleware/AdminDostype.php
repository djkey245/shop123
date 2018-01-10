<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class AdminDostype
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->role == 2) {
                return $next($request);
            }
            else{
                return redirect('/');
            }
        }
        return redirect('/');

    }
}
