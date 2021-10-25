<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboard extends Controller{

    # Menampilkan laman dashboard
    public function index(){

        return view('sellers/dashboard/index')->with(['title' => 'Welcome Sellers', 'sidebar' => 'Dashboard']);
    
    }

}