<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Toko extends Controller
{
    
    # Menampilkan views kategori toko
    public function kategoritoko(){

        $data = [
            'kategoritoko' => DB::table('kategoritoko')->orderBy('id_kategoritoko', "DESC")->get()
        ];

        return view('admin/toko/kategori_toko/kategori', $data)->with(['title'=> 'Kategori Toko', 'sidebar' => 'Kategori Toko']);

    }

    # Menampilkan views list toko
    public function datatoko(){

        # join 3 tabel (users, penjual, pasar)
        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'pasar.id_pasar', '=', 'penjual.id_pasar')->join('kategoritoko', 'kategoritoko.id_kategoritoko', '=', 'penjual.id_kategoritoko')->orderBy('penjual.id_penjual', "DESC")->get(),
            'pasar' => DB::table('pasar')->get(),
        ];
        return view('admin/toko/data_toko/index', $data)->with(['title'=> 'Data Toko', 'sidebar' => 'Data Toko']);

    }

    # Insert Kategori Toko
    public function insertkategoritoko(Request $request){
        $data  = [
            'nama_kategoritoko' => $request->post('nama_kategoritoko')
        ];
        
        DB::table('kategoritoko')->insert($data);

        return response()->json([
            'pesan' => 'Berhasi Tambah Kategori Toko'
        ]);
    }

    # Get Kategori Toko
    public function getkategoritoko(Request $request){
        return response()->json(
            DB::table('kategoritoko')->where('id_kategoritoko', $request->post('id_kategoritoko'))->get()
        );
    }

    # Update Kategori Toko
    public function updatekategoritoko(Request $request){
        $data  = [
            'nama_kategoritoko' => $request->post('nama_kategoritoko')
        ];
        
        DB::table('kategoritoko')->where('id_kategoritoko', $request->post('id_kategoritoko'))->update($data);

        return response()->json([
            'pesan' => 'Berhasi Edit Kategori Toko'
        ]);
    }

    # Hapus Kategori Toko
    public function deletekategoritoko(Request $request){
        DB::table('kategoritoko')->where('id_kategoritoko', $request->post('id_kategoritoko'))->delete();
        return response()->json([
            'pesan' => 'Berhasi Hapus Kategori Toko'
        ]);
    }

}
