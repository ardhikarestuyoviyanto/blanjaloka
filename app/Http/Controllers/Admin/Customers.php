<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Yajra\DataTables\Facades\DataTables;

class Customers extends Controller
{
    
    # Menampilkan laman data customers
    public function customers()
    {
        return view('admin/customers/index')->with(['title' => 'Data Customers', 'sidebar' => 'Data Customers']);
    }

    # get datatables customers
    public function customersjson(){
        return DataTables::of(Users::orderByDesc('id_users')->get())
        ->addIndexColumn()
        ->editColumn('created_at', function(Users $users){
            return date('d-M-Y', strtotime($users->created_at));
        })
        ->editColumn('updated_at', function(Users $users){
            return date('d-M-Y', strtotime($users->updated_at));
        })
        ->addColumn('status', function(Users $users){
            return $users->status == 'on' ? "<i class='text-primary'>Active</i>" : "<i class='text-danger'>Not-active</i>";
        })
        ->addColumn('action', function(Users $users){
            return '
                <a href='.url("admin/users/customers/edit/$users->id_users").' class="edit" data-toggle="tooltip" title="Edit" data-placement="top"><span class="badge badge-success"><i class="fas fa-edit"></i></span></a>
                <a href="#" data-id='.$users->id_users.' class="hapus_customers" data-toggle="tooltip" title="Hapus" data-placement="top"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a>
            ';
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    # Menampilkan laman tambah customers
    public function addcustomers(){
        
        $data = [
            'provinsi' => Province::pluck('name', 'code')
        ];

        return view('admin/customers/add', $data)->with(['title' => 'Tambah Customers', 'sidebar' => 'Data Customers']);
    }

    # Menampilkan laman edit customers
    public function editcustomers(Request $request){
        
        $data = [
            'customers' => Users::where('id_users', $request->segment('5'))->get(),
            'pasar' => DB::table('pasar')->get(),
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'penjual.id_pasar', '=', 'pasar.id_pasar')->where('users.id_users', $request->segment(5))->get(),
            'id_users' => $request->segment(5),
            'kategoritoko' => DB::table('kategoritoko')->get(),
            'provinsi' => Province::pluck('name', 'code'),
            'kabupaten' => City::pluck('name', 'code'),
            'kecamatan' => District::pluck('name', 'code')
        ];
        
        return view('admin/customers/edit', $data)->with(['title' => 'Edit Customers', 'sidebar' => 'Data Customers']);

    }

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
                'no_telp' => $request->post('no_telp'),
                'provinsi' => $request->post('provinsi'),
                'kabupaten' => $request->post('kabupaten'),
                'kecamatan' => $request->post('kecamatan')
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
                'no_telp' => $request->post('no_telp'),
                'provinsi' => $request->post('provinsi'),
                'kabupaten' => $request->post('kabupaten'),
                'kecamatan' => $request->post('kecamatan')
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
            'nama_toko' => $request->post('nama_toko'),
            'no_toko' => $request->post('no_toko'),
            'id_kategoritoko' => $request->post('id_kategoritoko')
        ];

        Seller::create($data);

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
