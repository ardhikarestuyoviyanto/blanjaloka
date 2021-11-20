<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProdukModels;
use App\Models\Kategori;
use App\Models\SatuanProdukModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Produk extends Controller{

    # Menampilkan laman data produk
    public function index(Request $request){

        if(!empty($request->get('kategoriproduk'))){

            $data = [
                'produk' => ProdukModels::join('satuan_produk', 'produk.id_satuanproduk', 'satuan_produk.id_satuanproduk')
                        ->where('id_penjual', $request->session()->get('id_penjual'))
                        ->where('id_kategoriproduk', $request->get('kategoriproduk'))->get(),
                'kategori' =>Kategori::all()
            ];

        }else{

            $data = [
                'produk' => ProdukModels::join('satuan_produk', 'produk.id_satuanproduk', 'satuan_produk.id_satuanproduk')
                        ->where('id_penjual', $request->session()->get('id_penjual'))->get(),
                'kategori' =>Kategori::all()
            ];

        }

        return view('sellers/produk/index',$data)->with(['title' => 'Produk Saya', 'sidebar' => 'Produk Saya']);
    
    }

    # Menampilkan laman input produk
    public function addproduk(){

        $data = [
            'kategori' =>Kategori::all(),
            'satuanproduk' => SatuanProdukModel::all()
        ];
        return view('sellers/produk/add',$data)->with(['title' => 'Produk Saya', 'sidebar' => 'Tambah Produk']);
    }


    # Proses tambah produk
    public function inputproduk(Request $request){

        if($request->hasFile('foto_produk')){
            
            $fotoproduk = $request->file('foto_produk');
            foreach($fotoproduk as $file){

                $filename = time().'_'. $file->getClientOriginalName();
                $file->move('assets/admin/foto_produk', $filename);
                $namaFile[] = $filename;
            
            }
            $data = [
                'nama_produk' => $request->post('nama_produk'),
                'harga' => str_replace(',', '', $request->post('harga')),
                'potongan_harga' => str_replace(',', '', $request->post('potongan_harga')) ,
                'deskripsi' => $request->post('deskripsi'),
                'jumlah_produk' => $request->post('jumlah_produk'),
                'id_kategoriproduk' => $request->post('id_kategoriproduk'),
                'slug' => Str::slug($request->post('nama_produk'), '-'),
                'status_produk' => $request->post('status_produk'),
                'id_penjual' => $request->session()->get('id_penjual')[0],
                'berat_produk' => str_replace(',', '', $request->post('berat_produk')),
                'total_views' => 0,
                'id_satuanproduk' => $request->post('id_satuanproduk'),
                'foto_produk' => implode(',', $namaFile),
            ];

            ProdukModels::create($data);
            
            return response()->json([
                'pesan' => "Data Produk Berhasil Disimpan",
                'val' => true
            ]);

        }
    }

    # Menampilkan laman edit produk
    public function editproduk(Request $request){

        $data = [
            'produk' => Kategori::join('produk', 'kategori.id_kategori', '=', 'produk.id_kategoriproduk')
                        ->join('satuan_produk', 'satuan_produk.id_satuanproduk', '=', 'produk.id_satuanproduk')
                        ->where('produk.id_penjual', $request->session()->get('id_penjual'))
                        ->where('produk.id_produk', $request->segment(4))->get(),
            'kategori' =>Kategori::all(),
            'satuanproduk' => SatuanProdukModel::all()
        ];
    
        return view('sellers/produk/edit', $data)->with(['title' => 'Produk Saya', 'sidebar' => 'Produk Saya']);
    
    }

    # Proses Hapus Gambar Porduk
    public function deletefotoproduk(Request $request){

        $produk = Kategori::join('produk', 'kategori.id_kategori', '=', 'produk.id_kategoriproduk')
                ->join('satuan_produk', 'satuan_produk.id_satuanproduk', '=', 'produk.id_satuanproduk')
                ->where('produk.id_penjual', $request->session()->get('id_penjual'))
                ->where('produk.id_produk', $request->post('id_produk'))->get();

        foreach($produk as $p):
            $arr_foto = explode(',', $p->foto_produk);
        endforeach;

        unset($arr_foto[$request->post('index')]);

        $data = [
            'foto_produk' => implode(',', $arr_foto)
        ];

        ProdukModels::where('id_produk', $request->post('id_produk'))->update($data);

        return response()->json([
            'pesan' => 'Foto Berhasil Dihapus'
        ]);

    }

    # Proses update produk
    public function updateproduk(Request $request){

        if($request->hasFile('foto_produk')){
            
            $fotoproduk = $request->file('foto_produk');
            
            foreach($fotoproduk as $file){

                $filename = time().'_'. $file->getClientOriginalName();
                $file->move('assets/admin/foto_produk', $filename);
                $namaFile[] = $filename;
            
            }

            $produk = Kategori::join('produk', 'kategori.id_kategori', '=', 'produk.id_kategoriproduk')
                    ->join('satuan_produk', 'satuan_produk.id_satuanproduk', '=', 'produk.id_satuanproduk')
                    ->where('produk.id_penjual', $request->session()->get('id_penjual'))
                    ->where('produk.id_produk', $request->post('id_produk'))->get();

            foreach($produk as $p):
                $arr_foto = explode(',', $p->foto_produk);
            endforeach;

            $new_image = array_merge($namaFile, $arr_foto);

            $data = [
                'foto_produk' => implode(',', $new_image),
            ];
            
            ProdukModels::where('id_produk', $request->post('id_produk'))->where('id_penjual', $request->session()->get('id_penjual'))->update($data);

        }

        $data = [
            'nama_produk' => $request->post('nama_produk'),
            'harga' => str_replace(',', '', $request->post('harga')),
            'potongan_harga' => str_replace(',', '', $request->post('potongan_harga')) ,
            'deskripsi' => $request->post('deskripsi'),
            'jumlah_produk' => $request->post('jumlah_produk'),
            'id_kategoriproduk' => $request->post('id_kategoriproduk'),
            'status_produk' => $request->post('status_produk'),
            'berat_produk' => str_replace(',', '', $request->post('berat_produk')),
            'id_satuanproduk' => $request->post('id_satuanproduk'),
        ];

        ProdukModels::where('id_produk', $request->post('id_produk'))->where('id_penjual', $request->session()->get('id_penjual'))->update($data);

        return response()->json([
            'pesan' => 'Produk Berhasil Diupdate'
        ]);

    }


    public function deleteproduk(Request $request){

        ProdukModels::where('id_produk', $request->post('id_produk'))->where('id_penjual', $request->session()->get('id_penjual'))->delete();
        return response()->json([
            'pesan' => 'Berhasil Hapus Data Produk'
        ]);
    }
}