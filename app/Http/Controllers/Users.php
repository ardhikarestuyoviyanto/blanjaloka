<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Users extends Controller
{
    # Halaman utama pembeli ketika berhasil login
    public function index(){

        return view('web/pembeli/index')->with(['title'=>'Beranda']);

    }
    
}
