<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $res = $this->validateLogin($request);
        Log::info($res);
        if ($this->attemptLogin($request)) {

            // check
            $user = Auth::user();
            if (($user->role == 'user' && ($request->input('role') == 'employee'))
                || ($user->role == 'employee' && ($request->input('role') == 'user'))
            ) {
                $user->role = 'user_employee';
                $user->save();
            }

            $token = Str::random(300);
            $request->user()->forceFill([
                'api_token' => $token
            ])->save();
            return response()->json([
                'status' => 'success',
                'user' => $request->user()
                , 'token' => $token

            ]);
        }
        return $this->sendFailedLoginResponse($request);
    }


}
