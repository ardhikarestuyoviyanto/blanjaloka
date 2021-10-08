<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth extends Controller
{
    
    public function userslogin(){

        return view('web/auth/login')->with(['title'=>'Login']);

    }

    public function usersregister(){

        return view('web/auth/register')->with(['title'=>'Register']);

    }

}
