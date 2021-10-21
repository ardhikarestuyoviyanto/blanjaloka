<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Sellers extends Controller
{
    
    # menampilkan laman data seller
    public function sellers(){

        # join 4 tabel (users, penjual, pasar, kategori toko)
        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'pasar.id_pasar', '=', 'penjual.id_pasar')->join('kategoritoko', 'kategoritoko.id_kategoritoko', '=', 'penjual.id_kategoritoko')->orderBy('penjual.id_penjual', "DESC")->get()
        ];
        return view('admin/sellers/index', $data)->with(['title'=> 'Data Sellers', 'sidebar' => 'Data Sellers']);

    }

    # menampilkan laman edit seller
    public function editsellers(Request $request){

        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'penjual.id_pasar', '=', 'pasar.id_pasar')->where('penjual.id_penjual', $request->segment(5))->get(),
            'pasar' => DB::table('pasar')->get(),
            'kategoritoko' => DB::table('kategoritoko')->get(),
            'id_penjual' => $request->segment(5)
        ];

        return view('admin/sellers/edit', $data)->with(['title'=> 'Edit Sellers', 'sidebar' => 'Data Sellers']);

    }

    # lihat data sensitive sellers
    public function datasensitivesellers(Request $request){

        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'penjual.id_pasar', '=', 'pasar.id_pasar')->where('penjual.id_penjual', $request->segment(5))->get(),
            'id_penjual' => $request->segment(5)
        ];

        return view('admin/sellers/datasensitive', $data)->with(['title'=> 'Data Sensitive Sellers', 'sidebar' => 'Data Sellers']);

    }

    # Hapus akun sellers
    public function deleteakunsellers(Request $request){

        Seller::where('id_penjual', $request->post('id_penjual'))->delete();
        return response()->json([
            'pesan' => 'Data Sellers Berhasil Dihapus'
        ]);

    }

    # Update akun sellers
    public function updatesellers(Request $request){

        $validator = Validator::make($request->all(),[
            'logo_toko' => 'mimes:jpeg,jpg,png,PNG,JPEG,JPG',
            'foto_toko.*' => 'mimes:jpeg,jpg,png'
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

            if($request->hasFile('foto_toko')){

                $fototoko = $request->file('foto_toko');
    
                foreach ($fototoko as $file){
    
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move('assets/admin/foto_toko/', $filename);
                    $namaFile[] = $filename;
    
                }
    
                $data = [
                    'foto_toko' => implode(',', $namaFile),
                ];

                Seller::where('id_penjual', $request->post('id_penjual'))->update($data);
    
            }
            
            $data = [
                'status' => $request->post('status'),
                'id_pasar' => $request->post('id_pasar'),
                'nama_toko' => $request->post('nama_toko'),
                'deskripsi_toko' => $request->post('deskripsi_toko'),
                'alamat_toko' => $request->post('alamat_toko'),
                'no_toko' => $request->post('no_toko'),
                'id_kategoritoko' => $request->post('id_kategoritoko'),
                'embbed_maps_toko' => $request->post('embbed_maps_toko')
            ];

            Seller::where('id_penjual', $request->post('id_penjual'))->update($data);

            return redirect('admin/users/sellers/edit/'.$request->post('id_penjual'))->with('success', 'Edit Data Sellers Berhasil');

        }

    }

    # hapus foto toko
    public function deletefototoko(Request $request){

        $arr_foto = explode(',', $request->post('foto_toko'));

        unset($arr_foto[$request->post('index')]);

        $data = [
            'foto_toko' => implode(',', $arr_foto)
        ];

        Seller::where('id_penjual', $request->post('id_penjual'))->update($data);

        return response()->json([
            'pesan' => 'Berhasi Hapus Foto Toko'
        ]);

    }

}
