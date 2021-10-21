<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Driver extends Controller{

    public function driver(){

        return view('admin/driver/index')->with(['title' => 'Data Driver', 'sidebar' => 'Data Driver']);

    }

}