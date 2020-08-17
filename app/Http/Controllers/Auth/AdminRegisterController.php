<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    //

    public function showRegisterForm(){

        return view('auth.admin.register');

    }

    public function register(){
        return true;
    }
}
