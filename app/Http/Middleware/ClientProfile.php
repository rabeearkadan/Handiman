<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientProfile
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

        $user = Auth::user();
        if($user->gender == null || $user->phone == null || $user->client_addresses==null)
            return redirect()->route('client.profile',['incomplete'=>true]);

        return $next($request);
    }
}
