<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest:web')->except('logout');
    }
    
    /*
    *
    * Show form login for user
    *
    */

    public function showLoginForm() {

        return view('auth.user.login');
    }

    /*
    *
    * validate and login
    */

    public function login(Request $request)
    {
       //validate this form data
        $this->validate($request, [
            'email' =>  'required|email',
            'password'  =>  'required|min:6',
        ]);

       
       //Attempt to log the user in
       if(Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password])){
            //if successful, then redirect to their intended location
            return redirect()->intended(route('user.profile', app()->getLocale()));

       }
       //if unsuccessful then redirect back to login with form data
       return redirect()->back()->with($request->only('email', 'remember'));

    }

    // public function credentials(Request $request){
    //     return $request->only($this->username(), 'password');
    // }
  

    /*
    *
    * User logout
    *
    */
    public function logout(Request $request)
    {
            Auth::guard('web')->logout();
        
        // elseif (Auth::guard('user')->check()) {
        //     Auth::guard('user')->logout();
        // }
    
      return redirect('/');
  
    }

}
