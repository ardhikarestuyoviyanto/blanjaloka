<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;

class Setting extends Controller
{
    # Halaman setting profil
    public function profil(Request $request){
        $data = [
            'customers' => Users::where('id_users', $request->session()->get('id_users'))->get()
        ];
        return view('web/pembeli/setting/profil', $data)->with(['title'=>'Setting Profil']);

    }

    # Update Data Profil
    public function updateprofil(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_user' => ['required', 'max:100'],
            'email' => ['required', 'email'],
            'no_telp' => ['required', 'min:12'],
        ]);

        if($validator->fails()){

            return redirect('setting/profil')->withErrors($validator);

        }

        $data = [
            'nama_user' => $request->post('nama_user'),
            'email' => $request->post('email'),
            'no_telp' => $request->post('no_telp'),
            'jeniskelamin' => $request->post('jeniskelamin'),
            'tgl_lahir' => $request->post('tgl_lahir')
        ];

        Users::where('id_users', $request->session()->get('id_users'))->update($data);

        return redirect('setting/profil')->with('success', 'Data Profil Anda Berhasil diupdate');

    }

    # Update Foto Profil Customer
    public function updatefotoprofil(Request $request){

        $img_array_1 = explode(';', $request->post('fotoprofil'));
        $img_array_2 = explode(',', $img_array_1[1]);

        $tmp_foto = base64_decode($img_array_2[1]);
        $filename = time().'_'.rand(0, 10).'.png';
                
        if(file_put_contents('assets/admin/foto_customers/'.$filename, $tmp_foto)){

            $data = [
                'fotoprofil' => $filename
            ];
            
            Users::where('id_users', $request->session()->get('id_users'))->update($data);
    
            return response()->json([
                'pesan' => 'Berhasil Update Foto Profil'
            ]);

        }else{

            return response()->json([
                'pesan' => 'Sistem Error Silahkan Coba Lagi Nanti'
            ]);

        }


    }

    # Halaman Setting Alamat
    public function alamat(Request $request){

        $data = [
            'customers' => Users::where('id_users', $request->session()->get('id_users'))->get(),
            'provinsi' => Province::pluck('name', 'code'),
            'kabupaten' => City::pluck('name', 'code'),
            'kecamatan' => District::pluck('name', 'code')
        ];

        return view('web/pembeli/setting/alamat', $data)->with(['title'=>'Setting Alamat']);;

    }

    # Update Alamat
    public function updatealamat(Request $request){

        $data = [
            'provinsi' => $request->post('provinsi'),
            'kabupaten' => $request->post('kabupaten'),
            'kecamatan' => $request->post('kecamatan'),
            'alamat' => $request->post('alamat')
        ];

        Users::where('id_users', $request->session()->get('id_users'))->update($data);

        return redirect('setting/alamat')->with('success', 'Alamat Pengiriman Berhasil Diupdate');

    }

    # Laman Ubah Password
    public function ubahpassword(){

        return view('web/pembeli/setting/password')->with(['title'=>'Ubah Password']);

    }

    # Update Password Handler
    public function ubahpassword_handler(Request $request){

        $validator = Validator::make($request->all(), [
            'password_new' => ['required', 'same:password_confirmation', Password::min(6)->mixedCase()->numbers()->letters(), 'different:password_now']
        ]);

        if($validator->fails()){

            return redirect('setting/ubahpassword')->withErrors($validator);

        }else{

            $users = DB::table('users')->select('password')->where('id_users', $request->session()->get('id_users'))->get()->toArray();

            if(Hash::check($request->post('password_now'), $users[0]->password)){

                $data = [
                    'password' => password_hash($request->post('password_new'), PASSWORD_DEFAULT)
                ];

                Users::where('id_users', $request->session()->get('id_users'))->update($data);

                return redirect('setting/ubahpassword')->with('success', 'Password Anda Berhasil Diubah, Silahkan Login Kembali');


            }else{

                return redirect('setting/ubahpassword')->with('error', 'Password Lama yang Anda Masukkan Salah');

            }


        }

    }
    
}
