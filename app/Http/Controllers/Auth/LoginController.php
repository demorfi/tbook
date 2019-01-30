<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @inheritdoc
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            /* @var $user \App\Contracts\User */
            $user = $this->guard()->user();
            $user->generateToken();

            return (response()->json(['data' => $user->toArray()]));
        }

        return ($this->sendFailedLoginResponse($request));
    }

    /**
     * @inheritdoc
     */
    public function logout(Request $request)
    {
        /* @var $user \App\Contracts\User */
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
            return (response()->json(['message' => 'User logged out'], 200));
        }

        return (response()->json(['error' => 'Unauthenticated'], 401));
    }
}
