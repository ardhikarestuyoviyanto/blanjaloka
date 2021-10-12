<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    # Menampilkan laman dashboard
    public function index(){

        return view('admin/dashboard/index')->with(['title' => 'Welcome Admin', 'sidebar' => 'Dashboard']);
    
    }

    # Menampilkan laman pasar
    public function pasar(){

        return view('admin/pasar/index')->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);

    }

    public function customers()
    {
        return view('admin/customers/index')->with(['title' => 'Data Customers', 'sidebar' => 'Data Customers']);
    }

    
}
