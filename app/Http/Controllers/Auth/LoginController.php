<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME; //protected property $redirectTo, used to specify the redirect URL when user logs in. by default users, are redirected to /home route but a different URL can be specified.

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //to modify a method you need to override the method in the controller.
    {
        $this->middleware('guest')->except('logout');
        //only a guest is able to run the login and register method but not logout. The middleware is allowing th eguest to access everything like login and register but not logout because only authorised users would neeed to logout.
    }
}
