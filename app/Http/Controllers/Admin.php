<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index()
    {
        return view('web/admin/index')->with(['title' => 'Admin']);
    }

    
}
