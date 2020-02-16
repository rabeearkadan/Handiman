<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
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
        if ( !Auth::check())
            return route("login");

        $user = Auth::user();
        if ( $user->user_role = 'employee' || $user->user_role == "user_employee"){
            return $next($request);
        }else{
            abort(403);
        }

    }
}
