<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    { 
      if (Auth::guard('admin')->check()) {

            return redirect('/manage/dashboard');
  
      } else if (Auth::guard('web')->check()) {
  
           return redirect('/profile');

            // return route('user.login', App::getLocale());
        
      }
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
    }
}
