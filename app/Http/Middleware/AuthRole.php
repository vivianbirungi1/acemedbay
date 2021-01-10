<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

      if (!$request->user() || !$request->user()->authorizeRoles($roles)){
        return redirect()->route('home'); //authorizing the roles of the user and redirecting them to the home route.
      }
        return $next($request); //returns the auth request
    }
}
