<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Toko extends Controller
{
    
    # Menampilkan views kategori toko
    public function kategoritoko(){

        $data = [
            'kategoritoko' => DB::table('kategoritoko')->orderBy('id_kategoritoko', "DESC")->get()
        ];

        return view('admin/toko/kategori_toko/kategori', $data)->with(['title'=> 'Kategori Toko', 'sidebar' => 'Kategori Toko']);

    }

    # Menampilkan views list toko
    public function datatoko(){

        $data = [
            'pasar' => DB::table('pasar')->get(),
        ];
        return view('admin/toko/data_toko/index', $data)->with(['title'=> 'Data Toko', 'sidebar' => 'Data Toko']);

    }

    # get datatables toko
    public function datatokojson(){

        $query = DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'pasar.id_pasar', '=', 'penjual.id_pasar')->join('kategoritoko', 'kategoritoko.id_kategoritoko', '=', 'penjual.id_kategoritoko')->orderBy('penjual.id_penjual', "DESC")->get();
        return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('status', function($query){
            return $query->status == 'on' ? "<i class='text-primary'>Active</i>" : "<i class='text-danger'>Not-active</i>";
        })
        ->addColumn('total_produk', function($query){

            # Belum Berfungsi
            return '23 Produk';

        })
        ->addColumn('action', function($query){
            
            if($query->status == 'on'){

                return '
                <a href="" data-toggle="tooltip" title="Lihat Toko" data-placement="top"><span class="badge badge-success"><i class="fas fa-store-alt"></i></span></a>
                <a href="'.url('admin/toko/jam/'.$query->id_penjual).'" data-toggle="tooltip" title="Jam Toko" data-placement="top"><span class="badge badge-info"><i class="fas fa-cog"></i></span></a>
                <a href="#" class="status" data-id="'.$query->id_penjual.'" data-status="off" data-pesan="Ubah Status Toko Menjadi Non Aktif ?" data-toggle="tooltip" title="Not Active" data-placement="top"><span class="badge badge-danger"><i class="fas fa-times"></i></span></a>
                ';

            }else{

                return '
                <a href="" data-toggle="tooltip" title="Lihat Toko" data-placement="top"><span class="badge badge-success"><i class="fas fa-store-alt"></i></span></a>
                <a href="'.url('admin/toko/jam/'.$query->id_penjual).'" data-toggle="tooltip" title="Jam Toko" data-placement="top"><span class="badge badge-info"><i class="fas fa-cog"></i></span></a>
                <a href="#" class="status" data-id="'.$query->id_penjual.'" data-status="on" data-pesan="Ubah Status Toko Menjadi Aktif ?" data-toggle="tooltip" title="Active" data-placement="top"><span class="badge badge-primary"><i class="fas fa-check-double"></i></span></a>
                ';

            }

        })
        ->rawColumns(['status', 'total_produk', 'action'])
        ->make(true);

    }

    # Insert Kategori Toko
    public function insertkategoritoko(Request $request){
        $data  = [
            'nama_kategoritoko' => $request->post('nama_kategoritoko')
        ];
        
        DB::table('kategoritoko')->insert($data);

        return response()->json([
            'pesan' => 'Berhasi Tambah Kategori Toko'
        ]);
    }

    # Get Kategori Toko
    public function getkategoritoko(Request $request){
        return response()->json(
            DB::table('kategoritoko')->where('id_kategoritoko', $request->post('id_kategoritoko'))->get()
        );
    }

    # Update Kategori Toko
    public function updatekategoritoko(Request $request){
        $data  = [
            'nama_kategoritoko' => $request->post('nama_kategoritoko')
        ];
        
        DB::table('kategoritoko')->where('id_kategoritoko', $request->post('id_kategoritoko'))->update($data);

        return response()->json([
            'pesan' => 'Berhasi Edit Kategori Toko'
        ]);
    }

    # Hapus Kategori Toko
    public function deletekategoritoko(Request $request){
        DB::table('kategoritoko')->where('id_kategoritoko', $request->post('id_kategoritoko'))->delete();
        return response()->json([
            'pesan' => 'Berhasi Hapus Kategori Toko'
        ]);
    }

    # Menampilkan Laman Jam Operasional Toko
    public function jamoperasionaltoko(Request $request){
        $data = [
            'id_penjual' => $request->segment(4),
            'jamtoko' => DB::table('jamtoko')->where('id_penjual', $request->segment(4))->get(),
            'sellers' => DB::table('pasar')->join('penjual', 'pasar.id_pasar', '=', 'penjual.id_pasar')->join('users', 'users.id_users', '=', 'penjual.id_users')->where('penjual.id_penjual', $request->segment(4))->get()
        ];
        
        return view('admin/toko/jam_operasional/index', $data)->with(['title'=> 'Jam Operasional Toko', 'sidebar' => 'Data Toko']);

    }

    # Simpan jam operasional toko
    public function insertjamtoko(Request $request){
        $data = [
            'catatan' => $request->post('catatan'),
            'hari' => $request->post('hari'),
            'buka' => $request->post('buka'),
            'tutup' => $request->post('tutup'),
            'id_penjual' => $request->post('id_penjual')
        ];

        DB::table('jamtoko')->insert($data);
        return response()->json([
            'pesan' => 'Berhasi Tambah Jam Operasional Toko'
        ]);

    }

    # Get Jam Kategori Toko
    public function getjamtoko(Request $request){
        return response()->json(
            DB::table('jamtoko')->where('id_jamtoko', $request->post('id_jamtoko'))->get()
        );
    }

    # Update Jam Toko
    public function updatejamtoko(Request $request){
        $data = [
            'catatan' => $request->post('catatan'),
            'hari' => $request->post('hari'),
            'buka' => $request->post('buka'),
            'tutup' => $request->post('tutup'),
        ];

        DB::table('jamtoko')->where('id_jamtoko', $request->post('id_jamtoko'))->update($data);
        return response()->json([
            'pesan' => 'Berhasi Update Jam Operasional Toko'
        ]);
    }

    # Delete Jam Toko
    public function deletejamtoko(Request $request){
        DB::table('jamtoko')->where('id_jamtoko', $request->post('id_jamtoko'))->delete();
        return response()->json([
            'pesan' => 'Berhasil Hapus Jam Toko'
        ]);
    }

    # Update status toko -> on -> off atau sebaliknya
    public function updatestatustoko(Request $request){
        DB::table('penjual')->where('id_penjual', $request->post('id_penjual'))->update(['status'=>$request->post('status')]);
        return response()->json([
            'pesan' => 'Berhasil Update Status Toko'
        ]);
    }

}
