<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Managers\AuthenticatesLdapUsers;
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

    use AuthenticatesUsers, AuthenticatesLdapUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest')->except('logout');
    }

    public function loginLdap(Request $request){
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if($this->attemptLoginLdap($request)){
            $checkUser = User::where('email',$request->get('email'))->first();
            if($checkUser){
                Auth::login($checkUser);
            }else{
                $name = explode('@',$request->get('email'));
                $user = new User();
                $user->name=$name[0];
                $user->email=$request->get('email');
                $user->password=bcrypt($request->get('password'));
                $user->save();
                $user->roles()->attach([
                    'role_id' => 3
                ]);
            }
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }




}
