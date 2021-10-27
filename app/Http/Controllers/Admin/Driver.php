<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengendara;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class Driver extends Controller{

    public function driver(){
    
        return view('admin/driver/index')->with(['title' => 'Data Driver', 'sidebar' => 'Data Driver']);
    
    }

    public function driverjson(){
    
        return DataTables::of(Pengendara::orderByDesc('id_driver')->get())
        ->addIndexColumn()
        ->editColumn('tgl_lahir', function(Pengendara $driver){
            return date('d-M-Y', strtotime($driver->tgl_lahir));
        })
        ->editColumn('created_at', function(Pengendara $driver){
            return date('d-M-Y', strtotime($driver->created_at));
        })
        ->editColumn('updated_at', function(Pengendara $driver){
            return date('d-M-Y', strtotime($driver->updated_at));
        })
        ->addColumn('action', function(Pengendara $driver){
            return '
                <a href="'.url('admin/users/driver/edit/'.$driver->id_driver).'" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                <a href="#" data-id="'.$driver->id_driver.'" class="delete_driver" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    
    }

    public function tambahform(){

        return view('admin/driver/add')->with(['title' => 'Data Driver', 'sidebar' => 'Data Driver']);
    
    }

    public function insertdriver(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_driver' => ['required', 'max:100'],
            'no_telp' => ['required', 'max:13'],
            'alamat' => ['required'],
            'tgl_lahir' => ['required'],
            'kendaraan' => ['required'],
            'no_ktp' => ['required'],
            'foto_stnk' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()){

            return redirect('admin/users/driver/add')->withErrors($validator)->withInput();

        }else{
            
            if($request->hasFile('foto_stnk')){

                $foto_stnk = $request->file('foto_stnk');

                $filename = time().'_'.$foto_stnk->getClientOriginalName();
                $foto_stnk->move('assets/admin/foto_stnk/', $filename);
    
                $data = [
                    'nama_driver' => $request["nama_driver"],
                    'no_telp' => $request["no_telp"],
                    'alamat' => $request["alamat"],
                    'tgl_lahir' => $request["tgl_lahir"],
                    'kendaraan' => $request["kendaraan"],
                    'no_ktp' => $request["no_ktp"],
                    'foto_stnk' => $filename
    
                ];

                Pengendara::create($data);
                return redirect('admin/users/driver/add')->with('success', 'Tambah Data Driver Berhasil');
            }
        }
    }

    public function editdriver(Request $request){

        $data = [
            'driver' => DB::table('driver')->where('id_driver', $request->segment(5))->get()
        ];
        return view('admin/driver/edit', $data)->with(['title' => 'Edit Driver', 'sidebar' => 'Data Driver']);
    }

    public function updatedriver(Request $request){

        $validator = Validator::make($request->all(),[
            'nama_driver' => ['required', 'max:100'],
            'no_telp' => ['required', 'max:13'],
            'alamat' => ['required'],
            'tgl_lahir' => ['required'],
            'kendaraan' => ['required'],
            'no_ktp' => ['required'],
            'foto_stnk' => 'mimes:jpeg,jpg,png'
        ]);

        if($validator->fails()){

            return redirect('admin/users/driver/edit/'.$request->post('id_driver'))->withErrors($validator)->withInput();

        }else{
            
            if($request->hasFile('foto_stnk')){

                $foto_stnk = $request->file('foto_stnk');
                $filename = time().'_'.$foto_stnk->getClientOriginalName();
                $foto_stnk->move('assets/admin/foto_stnk/', $filename);
                
                $data = [
                    'foto_stnk' => $filename
                ];

                Pengendara::where('id_driver', $request->post('id_driver'))->update($data);
            }

            $data = [
                'nama_driver' => $request["nama_driver"],
                'no_telp' => $request["no_telp"],
                'alamat' => $request["alamat"],
                'tgl_lahir' => $request["tgl_lahir"],
                'kendaraan' => $request["kendaraan"],
                'no_ktp' => $request["no_ktp"]

            ];

            Pengendara::where('id_driver', $request->post('id_driver'))->update($data);

            return redirect('admin/users/driver/edit/'.$request->post('id_driver'))->with('success', 'Data Driver Berhasil Diupdate');
        }
    }

    public function deletedriver(Request $request){

        DB::table('driver')->where('id_driver', $request->post('id_driver'))->delete();
        return response()->json([
            'pesan' => 'Data Driver Berhasil Dihapus'
        ]);
    
    }
}