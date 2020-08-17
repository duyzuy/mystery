<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use Auth;

class AdminLoginController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
       //validate this form data
        $this->validate($request, [
            'email' =>  'required|email',
            'password'  =>  'required|min:6',
        ]);

       
       //Attempt to log the user in
       if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password], $request->remember)){
            //if successful, then redirect to their intended location
            return redirect()->intended(route('manage.dashboard'));

       }
       //if unsuccessful then redirect back to login with form data
       return redirect()->back()->with($request->only('email', 'remember'));

    }

    public function logout(Request $request)
    {
        
            Auth::guard('admin')->logout();
        
        // elseif (Auth::guard('user')->check()) {
        //     Auth::guard('user')->logout();
        // }
         
      return redirect('/');
  
    }

  


}
