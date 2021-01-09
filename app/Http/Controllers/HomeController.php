<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //only authenticated users are allowed to use the following methods
    }

    /**
     * Controls access to dashboard when user logs in.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $user = Auth::user(); //when an authorised user signs in, they are taken to their home route
      $home = 'home';

//here we are defining which user tole is directed to which specific home rout.
//a user with a specific role such as admin will be redirected to the admin home dashboard.
    if($user->hasRole('admin')){
      $home = 'admin.home';
    }
    else if($user->hasRole('user')){ //else if the user isn't an admin they are redirected to the dashboard matching their role i. doctors, patients, visitts.
      $home = 'user.home';
    }
    else if($user->hasRole('doctor')){
      $home = 'doctor.home';
    }
    else if($user->hasRole('patient')){
      $home = 'patient.home';
    }
      return redirect()->route($home); //this is redirecting the user to the home route.
    }
}
