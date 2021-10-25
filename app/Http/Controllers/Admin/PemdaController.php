<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pemda;

class PemdaController extends Controller{

    public function pemda(){

        $data = [
            'pemda' =>Pemda::orderByDesc('id_pemda')->get()
        ];
        return view('admin/pemda/index',$data)->with(['title' => 'Data Pemda', 'sidebar' => 'Data Pemda']);

    }

    #insert data pemda
    public function insertpemda(Request $request){
        $data = [
            'nama_pemda' => $request->post('nama_pemda'),
            'alamat_pemda' => $request->post('alamat_pemda'),
            'no_telp' => $request->post('no_telp'),
            'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            'email' => $request->post('email'),
            'noktp' => $request->post('noktp')
        ];

        Pemda::create($data);

        return response()->json([
            'pesan' => 'Berhasil Menambahkan Pemda'
        ]);
    }

    # mendapatkan data pemda berdasarkan id
    public function getpemda(Request $request){
        return response()->json(
            Pemda::where('id_pemda', $request->post('id_pemda'))->get()
        );
        
    }

    # edit data pemda
    public function editpemda(Request $request){

        if(!empty($request->post('password'))){

            $data = [
                'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            ];

            Pemda::where('id_pemda', $request->post('id_pemda'))->update($data);

        }

        $data = [
            'nama_pemda' => $request->post('nama_pemda'),
            'alamat_pemda' => $request->post('alamat_pemda'),
            'no_telp' => $request->post('no_telp'),
            'email' => $request->post('email'),
            'noktp' => $request->post('noktp')
        ];

        Pemda::where('id_pemda', $request->post('id_pemda'))->update($data);

        return response()->json([
            'pesan' => 'Berhasil Mengedit Data Pemda'
        ]);

    }

    #hapus pemda pasar
    public function deletepemda(Request $request){

        Pemda::where('id_pemda', $request->post('id_pemda'))->delete();

        return response()->json([
            'pesan' => 'Berhasil Menghapus Data Pemda'
        ]);
        
    }

}