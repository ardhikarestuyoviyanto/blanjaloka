<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pemda extends Controller{

    public function pemda(){

        return view('admin/pemda/index')->with(['title' => 'Data Pemda', 'sidebar' => 'Data Pemda']);

    }

}