<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth'); //only the authenticated user have access to the methods below. unauthenticated users will not have any access to these methods.
      $this->middleware('role:admin');//only allows check of one role .
      //after modifying AuthRole you can now add a whole list

  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
      return view('admin.home');
  }
}
