<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Setting extends Controller{

    # Menampilkan laman akun saya
    public function akun(){

        return view('sellers/setting/akun')->with(['title' => 'Akun Saya', 'sidebar' => 'Akun Saya']);
    
    }

    # Menampilkan laman toko saya
    public function toko(){

        return view('sellers/setting/toko')->with(['title' => 'Toko Saya', 'sidebar' => 'Toko Saya']);

    }

}