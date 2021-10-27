<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;

class Location extends Controller
{
    //
    # Menampilkan data kabupaten jika dropdown provinsi dipilih
    public function kabupaten(Request $request){

        $cities = City::where('province_code', $request->post('id'))->pluck('name', 'code');
    
        return response()->json($cities);
    }

    # Menampilkan data kecamatan jika dropdown kabupaten dipilih
    public function kecamatan(Request $request){

        $districts = District::where('city_code', $request->post('id'))->pluck('name', 'code');

        return response()->json($districts);

    }

}
