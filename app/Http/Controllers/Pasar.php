<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Pasar extends Controller
{
    //
    # insert data pasar
    public function insertdatapasar(Request $request){

        $validator = Validator::make($request->all(),[
            'fotopasar' => 'required',
            'fotopasar.*' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()){

            return redirect('admin/pasar/add')->withErrors($validator)->withInput();

        }else{

            if($request->hasFile('fotopasar')){

                $fotopasar = $request->file('fotopasar');
    
                foreach ($fotopasar as $file){
    
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move('assets/admin/foto_pasar/', $filename);
                    $namaFile[] = $filename;
    
                }
    
                $data = [
                    'nama_pasar' => $request->post('nama_pasar'),
                    'alamat' => $request->post('alamat'),
                    'embbed_maps' => $request->post('embbed_maps'),
                    'foto_pasar' => implode(',', $namaFile),
                    'deskripsi' => $request->post('deskripsi')
                ];

                DB::table('pasar')->insert($data);
    
                return redirect('admin/pasar/add')->with('success', 'Tambah Data Pasar Berhasil');
    
            }

        }
    }

    # update data pasar
    public function updatedatapasar(Request $request){

        $validator = Validator::make($request->all(),[
            'fotopasar.*' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()){

            return redirect('admin/pasar/edit/'.$request->post('id_pasar'))->withErrors($validator);

        }else{

            if($request->hasFile('fotopasar')){

                $fotopasar = $request->file('fotopasar');
    
                foreach ($fotopasar as $file){
    
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move('assets/admin/foto_pasar/', $filename);
                    $namaFile[] = $filename;
    
                }
    
                $data = [
                    'foto_pasar' => implode(',', $namaFile),
                ];

                DB::table('pasar')->where('id_pasar', $request->post('id_pasar'))->update($data);
    
            }
            
            $data = [
                'nama_pasar' => $request->post('nama_pasar'),
                'alamat' => $request->post('alamat'),
                'embbed_maps' => $request->post('embbed_maps'),
                'deskripsi' => $request->post('deskripsi')
            ];

            DB::table('pasar')->where('id_pasar', $request->post('id_pasar'))->update($data);

            return redirect('admin/pasar/edit/'.$request->post('id_pasar'))->with('success', 'Edit Data Pasar Berhasil');

        }

    }

    # hapus foto pasar
    public function deletefotopasar(Request $request){

        $arr_foto = explode(',', $request->post('foto_pasar'));

        unset($arr_foto[$request->post('index')]);

        $data = [
            'foto_pasar' => implode(',', $arr_foto)
        ];

        DB::table('pasar')->where('id_pasar', $request->post('id_pasar'))->update($data);

        return response()->json([
            'pesan' => 'Berhasi Hapus Foto Pasar'
        ]);

    }

    # hapus pasar
    public function deletepasar(Request $request){

        DB::table('pasar')->where('id_pasar', $request->post('id_pasar'))->delete();
        return response()->json([
            'pesan' => 'Berhasi Hapus Data Pasar'
        ]);
    }

    //--------------------------------------------------------------------------------------------------

    # insert jam operasional pasar
    public function insertjamoperasionalpasar(Request $request){

        $data = [
            'catatan' => $request->post('catatan'),
            'hari' => $request->post('hari'),
            'buka' => $request->post('buka'),
            'tutup' => $request->post('tutup'),
            'id_pasar' => $request->post('id_pasar')
        ];

        DB::table('jampasar')->insert($data);
        
        return response()->json([
            'pesan' => 'Berhasil Tambah Jam Operasional Pasar'
        ]);

    }

    # get jam operasional pasar by id
    public function getjamoperasionalpasarbyid(Request $request){
        return response()->json(
            DB::table('jampasar')->where('id_jampasar', $request->post('id_jampasar'))->get()
        );
    }   

    # Update jam operasional pasar
    public function updatejamoperasionalpasar(Request $request){

        $data = [
            'catatan' => $request->post('catatan'),
            'hari' => $request->post('hari'),
            'buka' => $request->post('buka'),
            'tutup' => $request->post('tutup'),
        ];

        DB::table('jampasar')->where('id_jampasar', $request->post('id_jampasar'))->update($data);
        
        return response()->json([
            'pesan' => 'Berhasil Update Jam Operasional Pasar'
        ]);

    }

    # Delete jam operasional Pasar
    public function deletejamoperasionalpasar(Request $request){
        DB::table('jampasar')->where('id_jampasar', $request->post('id_jampasar'))->delete();
        return response()->json([
            'pesan' => 'Berhasil Hapus Jam Operasional Pasar'
        ]);
    }


}
