<?php

namespace App\Http\Controllers\Sellers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;

class Setting extends Controller{

    # Menampilkan laman akun saya
    public function akun(){
     $penjual=DB::table('penjual')
                    ->join('users', function($join) {
                        $join->on('penjual.id_users','=', 'users.id_users')
                    ->where('users.id_users','=', session()->get('id_users'));
                    })
                   ->get();
        $data= [
            'penjual' => $penjual
        ];

        return view('sellers/setting/akun',$data)->with(['title' => 'Akun Saya', 'sidebar' => 'Akun Saya']);
    
    }

    public function settingakun(Request $request)
    {
        # Validator
        $validator = Validator::make($request->all(), [
            'pin' => ['required', 'digits:6', 'numeric'],
            'no_ktp' => ['required', 'digits:16'],
            'foto_ktp' => ['required', 'mimes:jpeg,jpg,png,PNG,JPEG,JPG'],
            'foto_penjual_ktp' => ['required','mimes:jpeg,jpg,png,PNG,JPEG,JPG']
        ]);

        if($validator->fails()){

            return redirect('sellers/setting/akun')->withErrors($validator)->withInput();

        }else{

            try{

                if($request->hasFile('foto_ktp') && $request->hasFile('foto_penjual_ktp')){

                    $foto_ktp = $request->file('foto_ktp');
                    $foto_penjual_ktp = $request->file('foto_penjual_ktp');

                    $namafile_foto_ktp = time().'_'.$foto_ktp->getClientOriginalName();
                    $namafile_foto_penjual_ktp = time().'_'.$foto_penjual_ktp->getClientOriginalName();

                    $foto_ktp->move('assets/admin/foto_ktp', $namafile_foto_ktp);
                    $foto_penjual_ktp->move('assets/admin/foto_penjual_ktp', $namafile_foto_penjual_ktp);

                    $data = [
                        'pin' => $request->post('pin'),
                        'no_ktp' => $request->post('no_ktp'),
                        'foto_ktp' => $namafile_foto_ktp,
                        'foto_penjual_ktp' => $namafile_foto_penjual_ktp
                    ];

                    DB::table('penjual')->where('id_penjual', $request->post('id_penjual'))->update($data);

                    return redirect('sellers/setting/akun')->with('success', "Setting akun anda berhasil :)");

                }

            }catch(Exception $e){

                # Tampilkan pesan error
                dd($e->getMessage());
    
            }

        }
    }

    # Menampilkan laman toko saya
    public function toko(){
        $toko=DB::table('penjual')
                    ->where('id_users','=', session()->get('id_users'))->get();
        $data= [
            'toko' => $toko,
            'kategoritoko' => DB::table('kategoritoko')->get(),
        ];

        return view('sellers/setting/toko',$data)->with(['title' => 'Toko Saya', 'sidebar' => 'Toko Saya']);

    }

    public function settingtoko(Request $request){

    }

}