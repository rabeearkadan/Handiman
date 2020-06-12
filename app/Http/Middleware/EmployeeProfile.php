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
        if( $user->cv==null || $user->certificate==null ||$user->criminal_record==null) {
            dd("0");
            return redirect()->route('employee.profile', ['incomplete' => true]);
        }
elseif ($user->gender == null || $user->phone == null ){
            dd("1");
}
        elseif ($user->name == null || $user->employee_address==null ){
            dd("2");
        }
        elseif ($user->biography || isEmpty($user->service_ids) || $user->price==null ){
            dd("3");
        }
        return $next($request);
    }
}
