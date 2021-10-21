<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Pengelolapasar;

class Pasar extends Controller
{
    
    # Menampilkan laman pasar
    public function pasar(){

        $data = [
            'pasar' => DB::table('pasar')->join('pengelolapasar', 'pengelolapasar.id_pengelolapasar', '=', 'pasar.id_pengelolapasar')->orderBy('pasar.id_pasar', 'DESC')->get()
        ];

        return view('admin/pasar/data_pasar/index', $data)->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman tambah pasar
    public function addpasar(){

        $data = [
            'pengelola' => Pengelolapasar::orderByDesc('id_pengelolapasar')->get()
        ];

        return view('admin/pasar/data_pasar/add', $data)->with(['title' => 'Tambah Pasar', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman edit pasar
    public function editpasar(Request $request){

        $data = [
            'pasar' => DB::table('pasar')->where('id_pasar', $request->segment(4))->get(),
            'pengelola' => Pengelolapasar::orderByDesc('id_pengelolapasar')->get()
        ];

        return view('admin/pasar/data_pasar/edit', $data)->with(['title' => 'Edit Pasar', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman edit jam operasional
    public function jamoperasionalpasar(Request $request){

        $data = [
            'jampasar' => DB::table('jampasar')->where('id_pasar', $request->segment(4))->get(),
            'pasar' => DB::table('pasar')->join('pengelolapasar', 'pengelolapasar.id_pengelolapasar', '=', 'pasar.id_pengelolapasar')->where('pasar.id_pasar', $request->segment(4))->get(),
            'id_pasar' => $request->segment(4)
        ];

        return view('admin/pasar/data_pasar/jampasar', $data)->with(['title' => 'Jam Operasional', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman Pengelola Pasar
    public function pengelolapasar(){

        $data = [
            'pengelola' => Pengelolapasar::orderByDesc('id_pengelolapasar')->get()
        ];

        return view('admin/pasar/pengelola/index', $data)->with(['title' => 'Pengelola Pasar', 'sidebar' => 'Pengelola Pasar']);

    }

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
                    'deskripsi' => $request->post('deskripsi'),
                    'no_pasar' => $request->post('no_pasar'),
                    'max_lapak' => $request->post('max_lapak'),
                    'max_pengunjung' => $request->post('max_pengunjung'),
                    'id_pengelolapasar' => $request->post('id_pengelolapasar')
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
                'deskripsi' => $request->post('deskripsi'),
                'no_pasar' => $request->post('no_pasar'),
                'max_lapak' => $request->post('max_lapak'),
                'max_pengunjung' => $request->post('max_pengunjung'),
                'id_pengelolapasar' => $request->post('id_pengelolapasar')
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


    //----------------------------------------------------------------------------------------------

    # insert data pengelola pasar
    public function insertpengelolapasar(Request $request){

        $data = [
            'nip' => $request->post('nip'),
            'email' => $request->post('email'),
            'nama' => $request->post('nama'),
            'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            'jabatan' => $request->post('jabatan'),
            'role' => $request->post('role')
        ];

        Pengelolapasar::create($data);

        return response()->json([
            'pesan' => 'Berhasil Menambahkan Pengelola Pasar'
        ]);

    }

    # mendapatkan data pengelola pasar berdasarkan id
    public function getpengelolapasar(Request $request){
        return response()->json(
            Pengelolapasar::where('id_pengelolapasar', $request->post('id_pengelolapasar'))->get()
        );
        
    }

    # edit data pengelola pasar
    public function editpengelolapasar(Request $request){

        if(!empty($request->post('password'))){

            $data = [
                'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
            ];

            Pengelolapasar::where('id_pengelolapasar', $request->post('id_pengelolapasar'))->update($data);

        }

        $data = [
            'nip' => $request->post('nip'),
            'email' => $request->post('email'),
            'nama' => $request->post('nama'),
            'jabatan' => $request->post('jabatan'),
            'role' => $request->post('role')
        ];

        Pengelolapasar::where('id_pengelolapasar', $request->post('id_pengelolapasar'))->update($data);

        return response()->json([
            'pesan' => 'Berhasil Mengedit Data Pengelola Pasar'
        ]);

    }

    #hapus pengelola pasar
    public function deletepengelolapasar(Request $request){

        Pengelolapasar::where('id_pengelolapasar', $request->post('id_pengelolapasar'))->delete();

        return response()->json([
            'pesan' => 'Berhasil Menghapus Data Pengelola Pasar'
        ]);
        
    }

}
