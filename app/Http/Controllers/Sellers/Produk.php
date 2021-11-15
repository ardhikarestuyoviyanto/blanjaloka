<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProdukModels;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Produk extends Controller{

    # Menampilkan laman data produk
    public function index(){
        $data = [
            'produk' => ProdukModels::get(),
            'kategori' =>Kategori::all()
        ];
        return view('sellers/produk/index',$data)->with(['title' => 'Produk Saya', 'sidebar' => 'Produk Saya']);
    
    }

    public function addproduk()
    {
        $data = [
            'kategori' =>Kategori::all()
        ];
        return view('sellers/produk/add',$data)->with(['title' => 'Produk Saya', 'sidebar' => 'Tambah Produk']);

        
    }


    # Proses tambah produk
    public function inputproduk(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'jumlah_produk' => 'required|numeric',
            'id_kategoriproduk' => 'required',
            'deskripsi' => 'required',
            'status_produk' => 'required',
            'fotoproduk' => 'required',
            'fotoproduk.*' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails())
        {
            return redirect('sellers/produk/')->withErrors($validator)->withInput();            
        }
        else
        {
            if($request->hasFile('fotoproduk'))
            {
                $fotoproduk = $request->file('fotoproduk');
                foreach($fotoproduk as $file)
                {
                    $filename = time().'_'. $file->getClientOriginalName();
                    $file->move('assets/admin/foto_produk', $filename);
                    $namaFile[] = $filename;
                }
                $data = [
                    'nama_produk' => $request->post('nama_produk'),
                    'harga' => $request->post('harga'),
                    'jumlah_produk' => $request->post('jumlah_produk'),
                    'id_kategoriproduk' => $request->post('id_kategoriproduk'),
                    'status_produk' => $request->post('status_produk'),
                    'deskripsi' => $request->post('deskripsi'),
                    'foto_produk' => implode(',', $namaFile),
                    'penjual_id' => $request->post('id_penjual')
                ];

                DB::table('produk')->insert($data);
                return redirect('sellers/produk/index')->with('success', 'Tambah Data Pasar Berhasil');
            }
        }
    }
    public function editproduk(Request $request)
    {
        $data = [
            'produk' => ProdukModels::where('id_produk', $request->segment('4'))->get(),
            'kategori' =>Kategori::all()
        ];
        return view('sellers/produk/edit', $data)->with(['title' => 'Produk Saya', 'sidebar' => 'Produk Saya']);
    }

    public function updateproduk(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'jumlah_produk' => 'required|numeric',
            'id_kategoriproduk' => 'required',
            'deskripsi' => 'required',
            'status_produk' => 'required',
            'fotoproduk' => 'required',
            'fotoproduk.*' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails())
        {
            return redirect('sellers/produk/index')->withErrors($validator)->withInput();            
        }
        else
        {
            if($request->hasFile('fotoproduk'))
            {
                $fotoproduk = $request->file('fotoproduk');
                foreach($fotoproduk as $file)
                {
                    $filename = time().'_'. $file->getClientOriginalName();
                    $file->move('assets/admin/foto_produk', $filename);
                    $namaFile[] = $filename;
                }

                $data = [
                    'foto_produk' => implode(',', $namaFile),
                ];
                
                DB::table('produk')->where('id_produk', $request->post('id_produk'))->update($data);
            }

            $data = [
                'nama_produk' => $request->post('nama_produk'),
                'harga' => $request->post('harga'),
                'jumlah_produk' => $request->post('jumlah_produk'),
                'id_kategoriproduk' => $request->post('id_kategoriproduk'),
                'status_produk' => $request->post('status_produk'),
                'deskripsi' => $request->post('deskripsi'),
                'penjual_id' => $request->post('id_penjual')
            ];

            DB::table('produk')->where('id_produk', $request->post('id_produk'))->update($data);
            return redirect('sellers/produk/')->with('success', 'Update Data Pasar Berhasil');

        }
    }

    public function deleteproduk(Request $request)
    {
        DB::table('produk')->where('id_produk', $request->post('id_produk'))->delete();
        return response()->json([
            'pesan' => 'Berhasi Hapus Data Produk'
        ]);
    }
}