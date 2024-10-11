<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use App\Mail\VerifyEmail;
use App\Mail\AdminResponse;
use App\Mail\UserConfirmed;
use Illuminate\Http\Request;
use App\Mail\NewUserRegister;
use App\Mail\UserConfirmEmail;
use App\Mail\ResponseCompleted;
use App\Mail\UserResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRestaurentRegistration;

class MailController extends Controller
{
    /*
    *
    * send email to admin after user register
    */
    public static function sendSignupEmail($name, $email, $locale, $token, $file){
        $data = [
            'name'      =>  $name,
            'email'     =>  $email,
            'token'     =>  $token,
            'locale'    =>  $locale,
            'file'      =>  $file

        ];
        //send to admin
        Mail::to('vutruongduy2109@gmail.com')->send(new SignupEmail($data));
        //send to user
        Mail::to($email)->send(new NewUserRegister($data));
    }

    /*
    *
    * send email to user after admin approved
    */
    public static function sendVerifyedEmail($name, $email, $password, $survey, $token, $locale){
        $data = [
            'name'      =>  $name,
            'email'     =>  $email,
            'password'  =>  $password,
            'survey'    =>  $survey,
            'token'     =>  $token,
            'locale'    =>  $locale
            
        ];
        Mail::to($email)->send(new VerifyEmail($data));
    }

    public static function sendConfirmRegistrationRestaurent($name, $email, $time, $locale, $store, $token){
        $data = [
            'name'  =>  $name,
            'email' =>  $email,
            'check_in'  =>  $time,
            'locale'    =>  $locale,
            'store'     =>  $store,
            'token'     =>  $token,
        ];
        
        Mail::to($email)->send(new ConfirmRestaurentRegistration($data));
    }

    //send notify admin when user response email
    public static function sendUserConfirmEmail($name, $email, $response, $store){
        $data = [
            'name'  =>  $name,
            'email' =>  $email, 
            'response' =>  $response, 
            'store'     =>  $store
        ];
        
        Mail::to('vutruongduy2109@gmail.com')->send(new UserConfirmEmail($data));
    }


    public static function sendUserConfirmed($name, $email, $password, $locale, $response){
        $data = [
            'name'      =>  $name,
            'email'     =>  $email, 
            'password'  =>  $password,
            'locale'    =>  $locale,
            'response'  =>  $response
        ];
        
        Mail::to($email)->send(new UserConfirmed($data));
    }


    public static function sendResponeCompleted($name, $email, $lang){
        $data = [
            'name'      =>  $name,
            'email'     =>  $email,
            'locale'      =>  $lang,
            
        ];
        Mail::to($email)->send(new ResponseCompleted($data));
    }


    //user reset password

    public static function UserResetPassword($name, $email, $lang, $newpassword){
        $data = [
            'name'  =>  $name,
            'email' =>  $email,
            'locale'    =>  $lang,
            'password'  =>  $newpassword,
        ];
        Mail::to($email)->send(new UserResetPassword($data));

    }

    public static function sendAdminRsponse($name, $email, $store){
        $data = [
            'name'  =>  $name,
            'email' =>  $email,
            'store'    =>  $store,
        ];
        
        Mail::to('vutruongduy2109@gmail.com')->send(new AdminResponse($data));

    }

}
