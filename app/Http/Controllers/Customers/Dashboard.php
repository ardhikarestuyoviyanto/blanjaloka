<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasar;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\Province;

class Dashboard extends Controller
{
    # Halaman utama pembeli ketika berhasil login
    public function index(){

        $data = [
            'pasar' => Pasar::all(),
            'provinsi' => Province::pluck('name', 'code'),
        ];

        return view('web/pembeli/beranda/index')->with(['title'=>'Beranda', 'data'=>$data]);

    }

    # get detail pasar
    public function getdetailpasar(Request $request){

        return response()->json([
            'jampasar' => DB::table('jampasar')->where('id_pasar', $request->post('id_pasar'))->get(),
            'pasardetail' => Pasar::where('id_pasar', $request->post('id_pasar'))->get()
        ]);

    }

    # Menerapkan Pasar
    public function terapkanpasar(Request $request){
        $request->session()->forget(['id_pasar', 'nama_pasar']);
        
        $request->session()->put('id_pasar', $request->post('id_pasar'));
        $request->session()->put('nama_pasar', $request->post('nama_pasar'));

        return response()->json([
            'pesan' => 'Anda Sekarang Berada di '.$request->post('nama_pasar').' Selamat Berbelanja !'
        ]);

    }
    
}
