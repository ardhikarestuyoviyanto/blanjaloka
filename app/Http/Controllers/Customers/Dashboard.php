<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    # Halaman utama pembeli ketika berhasil login
    public function index(){

        return view('web/pembeli/beranda/index')->with(['title'=>'Beranda']);

    }
    
}
