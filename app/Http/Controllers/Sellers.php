<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class Sellers extends Controller
{
    //
    public function deleteakunsellers(Request $request){

        Seller::where('id_penjual', $request->post('id_penjual'))->delete();
        return response()->json([
            'pesan' => 'Data Sellers Berhasil Dihapus'
        ]);

    }
}
