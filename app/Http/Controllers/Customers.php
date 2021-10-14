<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class Customers extends Controller
{
    # tambah customers
    public function insertcustomers(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_user' => ['required', 'max:100'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', Password::min(6)->mixedCase()->numbers()->letters()],
            'no_telp' => ['required', 'unique:users'],
            'alamat' => ['required'],
            'status' => ['required']
        ]);

        if($validator->fails()){

            return redirect('admin/users/customers/add')->withErrors($validator)->withInput();

        }else{

            $data = [
                'nama_user' => $request->post('nama_user'),
                'email' => $request->post('email'),
                'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
                'status' => $request->post('status'),
                'alamat' => $request->post('alamat'),
                'no_telp' => $request->post('no_telp')
            ];

            Users::create($data);

            return redirect('admin/users/customers/add')->with('success', 'Tambah Data Customers Berhasil');

        }

    }

    # update customers
    public function updatecustomers(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_user' => 'required|max:100',
            'email' => 'required|email',
            'no_telp' => 'required',
            'alamat' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){

            return redirect('admin/users/customers/edit/'.$request->post('id_users'))->withErrors($validator);

        }else{

            # cek password kosong atau gak
            if(!empty($request->post('password'))){

                $validator = Validator::make($request->all(), [
                    'password' => ['required', Password::min(6)->mixedCase()->numbers()->letters()],
                ]);

                if($validator->fails()){

                    return redirect('admin/users/customers/edit/'.$request->post('id_users'))->withErrors($validator);

                }

                $data = [
                    'password' => password_hash($request->post('password'), PASSWORD_DEFAULT)
                ];

                Users::where('id_users', $request->post('id_users'))->update($data);

            }

            $data = [
                'nama_user' => $request->post('nama_user'),
                'email' => $request->post('email'),
                'status' => $request->post('status'),
                'alamat' => $request->post('alamat'),
                'no_telp' => $request->post('no_telp')
            ];

            Users::where('id_users',$request->post('id_users'))->update($data);

            return redirect('admin/users/customers/edit/'.$request->post('id_users'))->with('success', 'Edit Data Customers Berhasil');

        }

    }

    # jadikan akun customers -> sellers
    public function makesellers(Request $request){

        $data = [
            'status' => $request->post('status'),
            'id_users' => $request->post('id_users'),
            'id_pasar' => $request->post('id_pasar'),
            'nama_toko' => $request->post('nama_toko')
        ];

        DB::table('penjual')->insert($data);

        return redirect('admin/users/customers/edit/'.$request->post('id_users'))->with('success', 'Akun Sellers Berhasil Dibuat');

    }

    # hapus akun customers
    public function deletecustomers(Request $request){
        DB::table('users')->where('id_users', $request->post('id_users'))->delete();
        return response()->json([
            'pesan' => 'Data Customers Berhasil Dihapus'
        ]);
    }



}
