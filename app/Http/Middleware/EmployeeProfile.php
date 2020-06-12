<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeProfile
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
        if( $user->cv==null || $user->certificate==null ||$user->criminal_record==null || $user->biography || $user->price==null || $user->gender == null || $user->phone == null || $user->name == null || $user->employee_address==null ) {
            return redirect()->route('employee.profile', ['incomplete' => true]);
        }
        return $next($request);
    }
}
