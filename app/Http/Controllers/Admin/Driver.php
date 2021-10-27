<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengendara;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Driver extends Controller{

    public function driver(){
        $driver = Pengendara::all();
        return view('admin/driver/index', compact('driver'))->with(['title' => 'Data Driver', 'sidebar' => 'Data Driver']);
    }

    public function tambahform()
    {
        return view('admin/driver/add')->with(['title' => 'Data Driver', 'sidebar' => 'Data Driver']);
    }

    public function insertdriver(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_driver' => ['required', 'max:100'],
            'no_telp' => ['required', 'max:13'],
            'alamat' => ['required'],
            'tgl_lahir' => ['required'],
            'kendaraan' => ['required'],
            'no_ktp' => ['required'],
            'foto_stnk' => 'required',
            'foto_stnk.*' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()){

            return redirect('admin/users/driver')->withErrors($validator)->withInput();

        }else
        {
            
            if($request->hasFile('foto_stnk')){

                $foto_stnk = $request->file('foto_stnk');
    
                foreach ($foto_stnk as $file){
    
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move('assets/admin/foto_stnk/', $filename);
                    $namaFile[] = $filename;
    
                }

                $data = [
                    'nama_driver' => $request["nama_driver"],
                    'no_telp' => $request["no_telp"],
                    'alamat' => $request["alamat"],
                    'tgl_lahir' => $request["tgl_lahir"],
                    'kendaraan' => $request["kendaraan"],
                    'no_ktp' => $request["no_ktp"],
                    'foto_stnk' => implode(',', $namaFile)
    
                ];

                DB::table('driver')->insert($data);
                return redirect('admin/users/driver')->with('success', 'Tambah Data Pasar Berhasil');
            }
        }
    }

    public function editdriver(Request $request)
    {
        $data = [
            'driver' => DB::table('driver')->where('id_driver', $request->segment(5))->get()
        ];
        return view('admin/driver/edit', $data)->with(['title' => 'Edit Driver', 'sidebar' => 'Data Driver']);
    }

    public function updatedriver(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_driver' => ['required', 'max:100'],
            'no_telp' => ['required', 'max:13'],
            'alamat' => ['required'],
            'tgl_lahir' => ['required'],
            'kendaraan' => ['required'],
            'no_ktp' => ['required'],
            'foto_stnk' => 'required',
            'foto_stnk.*' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()){

            return redirect('admin/users/driver')->withErrors($validator)->withInput();

        }else
        {
            
            if($request->hasFile('foto_stnk')){

                $foto_stnk = $request->file('foto_stnk');
    
                foreach ($foto_stnk as $file){
    
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move('assets/admin/foto_stnk/', $filename);
                    $namaFile[] = $filename;
                    
                    $data = [
                        'foto_stnk' => implode(',', $namaFile)
                    ];
                    DB::table('driver')->where('id_driver', $request->post('id_driver'))->update($data);
                }
            }

            $data = [
                'nama_driver' => $request["nama_driver"],
                'no_telp' => $request["no_telp"],
                'alamat' => $request["alamat"],
                'tgl_lahir' => $request["tgl_lahir"],
                'kendaraan' => $request["kendaraan"],
                'no_ktp' => $request["no_ktp"]

            ];

            DB::table('driver')->where('id_driver', $request->post('id_driver'))->update($data);

            return redirect('admin/users/driver/')->with('success', 'Update Data Pasar Berhasil');
        }
    }
    public function deletedriver(Request $request)
    {
        DB::table('driver')->where('id_driver', $request->post('id_driver'))->delete();
        return response()->json([
            'pesan' => 'Data Customers Berhasil Dihapus'
        ]);
    }
}