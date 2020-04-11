<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    public function username()
    {
        return 'username';
    }
    public function apiLogin(Request $request) {

        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'نام کاربر یا رمز عبور اشتباه می‌باشد'], 401);
            }
        } catch (JWTException $e) {
            throw new \Exception('', 500);
        }

        return response()->json([
            "message" => "با موفقیت وارد شدید",
            "token" => $token
        ], 200);
    }
//
//    protected function credentials(Request $request) {
//        return array_merge($request->only($this->username(), 'password'), ['role' => 0]);
//    }
}
