<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboard extends Controller{

    # Menampilkan laman dashboard
    public function index(){

        return view('admin/dashboard/index')->with(['title' => 'Welcome Admin', 'sidebar' => 'Dashboard']);
    
    }

}