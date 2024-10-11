<?php

namespace App\Http\Controllers\Auth;

use App\Admin;

use Illuminate\Http\Request;
use App\Components\FlashMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    use FlashMessages;
    
    function resetpassword(){
        return view('auth.passwords.reset');
    }

    function updatePassword(Request $request){
      

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        
        $admin = Admin::where("email", $request->email)->firstOrFail();

        if(!$admin) {
            self::error("can't update password");
            return redirect()->back();
        }
        $admin->password = Hash::make($request->password);
        $admin->save();

        self::success("Update password success");
        
        return redirect()->route('manage.dashboard');
        
    }
}
