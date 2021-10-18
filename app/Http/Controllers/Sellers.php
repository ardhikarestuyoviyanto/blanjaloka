<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Sellers extends Controller
{
    //
    public function deleteakunsellers(Request $request){

        Seller::where('id_penjual', $request->post('id_penjual'))->delete();
        return response()->json([
            'pesan' => 'Data Sellers Berhasil Dihapus'
        ]);

    }

    public function updatesellers(Request $request){

        $validator = Validator::make($request->all(),[
            'logo_toko' => 'mimes:jpeg,jpg,png,PNG,JPEG,JPG'
        ]);

        if($validator->fails()){

            return redirect('admin/users/sellers/edit/'.$request->post('id_penjual'))->withErrors($validator);

        }else{

            if($request->hasFile('logo_toko')){

                $logotoko = $request->file('logo_toko');
    
                $filename = time().'_'.$logotoko->getClientOriginalName();
                $logotoko->move('assets/admin/logo_toko/', $filename);
    
                $data = [
                    'logo_toko' => $filename,
                ];

                Seller::where('id_penjual', $request->post('id_penjual'))->update($data);
    
            }
            
            $data = [
                'status' => $request->post('status'),
                'id_pasar' => $request->post('id_pasar'),
                'nama_toko' => $request->post('nama_toko'),
                'deskripsi_toko' => $request->post('deskripsi_toko')
            ];

            Seller::where('id_penjual', $request->post('id_penjual'))->update($data);

            return redirect('admin/users/sellers/edit/'.$request->post('id_penjual'))->with('success', 'Edit Data Sellers Berhasil');

        }

    }

}
