<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $user = new  User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->role = $data['role'];
        $user->isApproved = false;
        $user->password = Hash::make($data['password']);

        $user->save();
        return $user;
    }

    public function initTimeline()
    {
        $timeline = [];
        for ($i = 0; $i <= 23; $i++) {
            $hour = str_pad($i,
                    2, 0, STR_PAD_LEFT) . "00";

            for ($j = 0; $j <= 6; $j++) {
                $timeline[$j][$hour] = false;
            }

        }

        return $timeline;


    }

    //on new users ? or on update users ?Update
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        auth::login($user);
        $user = Auth::user();
        if ($request->input('role') == 'employee') {

            $user->role = 'employee';
            $user->timeline = $this->initTimeline();

            $user->save();
        } elseif ($request->input('role') == 'user') {
            $user->role = 'user';
            $user->save();
        }
        if ($this->guard()->check()) {
            $token = Str::random(300);
            $user->forceFill([
                'api_token' => $token

            ])->save();
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token,
                '_id'=> $user->id
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'registration failed']);
        }

    }
}
