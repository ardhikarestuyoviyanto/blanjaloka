<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\ProdukModels;
use App\Models\Seller;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use App\Models\Bank;

class Setting extends Controller{
    
    # Menampilkan laman akun saya
    public function akun(Request $request){
        $data= [
            'penjual' => Seller::join('users', 'penjual.id_users', '=', 'users.id_users')
                        ->where('penjual.id_penjual', $request->session()->get('id_penjual'))->get()
        ];

        return view('sellers/setting/akun',$data)->with(['title' => 'Akun Saya', 'sidebar' => 'Akun Saya']);
    
    }

    # Upload Foto KTP
    public function updatefotoktp(Request $request){

        $img_array_1 = explode(';', $request->post('foto_ktp'));
        $img_array_2 = explode(',', $img_array_1[1]);

        $tmp_foto = base64_decode($img_array_2[1]);
        $filename = time().'_'.rand(0, 10).'.png';
                
        if(file_put_contents('assets/admin/foto_ktp/'.$filename, $tmp_foto)){

            $data = [
                'foto_ktp' => $filename
            ];
            
            Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

            return response()->json([
                'pesan' => 'Berhasil Update Foto Ktp'
            ]);

        }else{

            return response()->json([
                'pesan' => 'Sistem Error Silahkan Coba Lagi Nanti'
            ]);

        }

    }

    # Upload Foto KTP dipegang penjual
    public function updatefotopenjualktp(Request $request){

        $img_array_1 = explode(';', $request->post('foto_penjual_ktp'));
        $img_array_2 = explode(',', $img_array_1[1]);

        $tmp_foto = base64_decode($img_array_2[1]);
        $filename = time().'_'.rand(0, 10).'.png';
                
        if(file_put_contents('assets/admin/foto_penjual_ktp/'.$filename, $tmp_foto)){

            $data = [
                'foto_penjual_ktp' => $filename
            ];
            
            Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

            return response()->json([
                'pesan' => 'Berhasil Update Foto Penjual Memegang Ktp'
            ]);

        }else{

            return response()->json([
                'pesan' => 'Sistem Error Silahkan Coba Lagi Nanti'
            ]);

        }

    }

    # Update Akun Saya
    public function settingakun(Request $request){

        # Validator
        $validator = Validator::make($request->all(), [
            'no_ktp' => ['required', 'digits:16'],
        ]);

        if($validator->fails()){

            return redirect('sellers/setting/akun')->withErrors($validator)->withInput();

        }else{

            $data = [
                'no_ktp' => $request->post('no_ktp'),
            ];

            Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

            return redirect('sellers/setting/akun')->with('success', "Setting akun anda berhasil Diperbaruhi");

        }
    }

    # Update PIN Penjual
    public function updatepinpenjual(Request $request){

        $validator = Validator::make($request->all(), [
            'pin_baru' => ['digits:6', 'numeric']
        ]);

        if($validator->fails()){

            return redirect('sellers/setting/akun')->withErrors($validator);

        }else{

            $seller = Seller::where('id_penjual', $request->session()->get('id_penjual'))->get();

            foreach($seller as $s){

                if($s->pin == $request->post('pin_lama')){

                    $data = [
                        'pin' => $request->post('pin_baru')
                    ];
    
                    Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);
    
                    return redirect('sellers/setting/akun')->with('success', "PIN Penjual Berhasil Diperbaruhi");
    
                }else{
    
                    return redirect('sellers/setting/akun')->with('success', "PIN Lama Salah");
    
                }

            }
        }


    }

    # handler create PIN PENJUAL
    public function createPinSellers(Request $request){

        $validator = Validator::make($request->all(), [
            'pin' => ['digits:6', 'numeric', 'confirmed']
        ]);

        if($validator->fails()){

            return redirect($request->post('route'))->withErrors($validator);

        }else{

            $data = [
                'pin' => $request->post('pin')
            ];

            Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

            return redirect($request->post('route'));

        }

    }

    # Menampilkan laman Toko Saya
    public function toko(Request $request){

        $data= [
            'toko' => Seller::where('id_penjual', $request->session()->get('id_penjual'))->get(),
            'kategoritoko' => DB::table('kategoritoko')->get(),
            'total_produk' => count(ProdukModels::where('id_penjual', $request->session()->get('id_penjual'))->get())
        ];

        return view('sellers/setting/toko',$data)->with(['title' => 'Toko Saya', 'sidebar' => 'Toko Saya']);

    }

    # Hapus Foto Toko Saya
    public function deletefototoko(Request $request){

        $toko = Seller::where('id_penjual', $request->session()->get('id_penjual'))->get();

        foreach ($toko as $t){
            $arr_foto = explode(',', $t->foto_toko);
        }

        unset($arr_foto[$request->post('index')]);

        $data = [
            'foto_toko' => implode(',', $arr_foto)
        ];

        Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

        return response()->json([
            'pesan' => 'Foto Toko Berhasil Dihapus'
        ]);

    }

    # Setting toko Handler
    public function updatetoko(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_toko' => 'min:6'
        ]);

        if($validator->fails()){

            return redirect('sellers/setting/toko')->withErrors($validator);

        }else{

            if($request->hasFile('foto_toko')){

                $toko = Seller::where('id_penjual', $request->session()->get('id_penjual'))->get();
    
                foreach ($toko as $t){
                    $arr_foto = explode(',', $t->foto_toko);
                }
    
                $fototoko = $request->file('foto_toko');
                
                foreach ($fototoko as $file){
    
                    $filename = time().'_'. $file->getClientOriginalName();
                    $file->move('assets/admin/foto_toko', $filename);
                    $namaFile[] = $filename;
    
                }
    
                $new_image = array_merge($namaFile, $arr_foto);
                
                $data = [
                    'foto_toko' => implode(',', $new_image)
                ];
    
                Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);
    
            }
            
    
            $data = [
                'nama_toko' => $request->post('nama_toko'),
                'id_kategoritoko' => $request->post('id_kategoritoko'),
                'deskripsi_toko' => $request->post('deskripsi_toko')
            ];
    
            Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);
    
            return redirect('sellers/setting/toko')->with('success', "Profil Toko Berhasil Diperbaruhi");

        }
    }

    # Edit Logo Toko
    public function updatelogoToko(Request $request){

        $img_array_1 = explode(';', $request->post('logo_toko'));
        $img_array_2 = explode(',', $img_array_1[1]);

        $tmp_foto = base64_decode($img_array_2[1]);
        $filename = time().'_'.rand(0, 10).'.png';
                
        if(file_put_contents('assets/admin/logo_toko/'.$filename, $tmp_foto)){

            $data = [
                'logo_toko' => $filename
            ];
            
            Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

            return response()->json([
                'pesan' => 'Berhasil Update Logo Foto'
            ]);

        }else{

            return response()->json([
                'pesan' => 'Sistem Error Silahkan Coba Lagi Nanti'
            ]);

        }

    }

    # Alamat Toko
    public function alamatToko(Request $request){

        $data = [
            'toko' => Seller::join('pasar', 'pasar.id_pasar', '=', 'penjual.id_pasar')->where('id_penjual', $request->session()->get('id_penjual'))->get(),
            'provinsi' => Province::pluck('name', 'code'),
            'kabupaten' => City::pluck('name', 'code'),
            'kecamatan' => District::pluck('name', 'code')        
        ];

        return view('sellers/setting/alamat', $data)->with(['title' => 'Alamat Toko', 'sidebar' => 'Alamat Toko']);

    }

    # Update Alamat Toko
    public function updateAlamatToko(Request $request){

        $data = [
            'alamat_toko' => $request->post('alamat_toko'),
            'embbed_maps_toko' => $request->post('embbed_maps_toko')
        ];

        Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

        return redirect('sellers/setting/alamat')->with('success', "Alamat Toko Berhasil Diperbaruhi");

    }

    # Rekening
    public function rekening(Request $request){

        $data = [
            'toko' => Seller::where('id_penjual', $request->session()->get('id_penjual'))->get(),
            'bank' => Bank::all() 
        ];
        
        return view('sellers/setting/rekening', $data)->with(['title' => 'Rekening Bank', 'sidebar' => 'Rekening Bank']);

    }

    # Update Rekening Bank
    public function updaterekening(Request $request){

        $data = [
            'nama_bank' => $request->post('nama_bank'),
            'atas_nama_bank' => $request->post('atas_nama_bank'),
            'no_rekening' => $request->post('no_rekening')
        ];

        Seller::where('id_penjual', $request->session()->get('id_penjual'))->update($data);

        return redirect('sellers/setting/rekening')->with('success', "Rekening Bank Berhasil Diperbaruhi");

    }

    

}