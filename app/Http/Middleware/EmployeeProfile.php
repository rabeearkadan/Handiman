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
        if($user->gender == null || $user->phone == null || $user->name == null || $user->employee_address==null || $user->biography || $user->service_ids == null || $user->price==null || $user->cv==null || $user->certificate==null ||$user->criminal_record==null)
            return redirect()->route('employee.profile',['incomplete'=>true]);

        return $next($request);
    }
}
