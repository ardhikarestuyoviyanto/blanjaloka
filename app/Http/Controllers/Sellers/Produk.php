<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Produk extends Controller{

    # Menampilkan laman data produk
    public function index(){

        return view('sellers/produk/index')->with(['title' => 'Produk Saya', 'sidebar' => 'Produk Saya']);
    
    }

    # Menampilkan laman tambah produk
    public function addproduk(){

        return view('sellers/produk/add')->with(['title' => 'Tambah Produk', 'sidebar' => 'Tambah Produk']);

    }

}