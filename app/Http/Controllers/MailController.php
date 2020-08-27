<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Mail\NewUserRegister;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /*
    *
    * send email to admin after user register
    */
    public static function sendSignupEmail($name, $email, $token){
        $data = [
            'name'  =>  $name,
            'email' =>  $email,
            'token' =>  $token
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
    public static function sendVerifyedEmail($name, $email, $password, $survey, $token){
        $data = [
            'name'      =>  $name,
            'email'     =>  $email,
            'password'  =>  $password,
            'survey'    =>  $survey,
            'token'     =>  $token,
            
        ];
        Mail::to($email)->send(new VerifyEmail($data));
    }

    // public static function sendToInformToNewUser($name, $email){
    //     $data = [
    //         'name'      =>  $name,
    //         'email'     =>  $email,
            
    //     ];
       
    // }

}
