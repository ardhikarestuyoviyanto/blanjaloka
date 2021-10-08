<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function index(){
        
        return view('web/homepage/index')->with(['title'=>'Selamat Datang']);

    }
}
