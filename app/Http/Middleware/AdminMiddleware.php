<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        dd('message vhjvjh');

        $user = Auth::user();
        if ( $user->role = 'admin' ){
            return $next($request);
        }else{
            abort(403);
        }
    }
}
