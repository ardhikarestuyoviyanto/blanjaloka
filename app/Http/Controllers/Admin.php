<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class Admin extends Controller
{
    # Menampilkan laman dashboard
    public function index(){

        return view('admin/dashboard/index')->with(['title' => 'Welcome Admin', 'sidebar' => 'Dashboard']);
    
    }

    # Menampilkan laman pasar
    public function pasar(){

        $data = [
            'pasar' => DB::table('pasar')->orderBy('id_pasar', 'DESC')->get()
        ];

        return view('admin/pasar/index', $data)->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman tambah pasar
    public function addpasar(){

        return view('admin/pasar/add')->with(['title' => 'Tambah Pasar', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman edit pasar
    public function editpasar(Request $request){

        $data = [
            'pasar' => DB::table('pasar')->where('id_pasar', $request->segment(4))->get()
        ];

        return view('admin/pasar/edit', $data)->with(['title' => 'Edit Pasar', 'sidebar' => 'Data Pasar']);

    }

    # Menampilkan laman edit jam operasional
    public function jamoperasionalpasar(Request $request){

        $data = [
            'jampasar' => DB::table('jampasar')->where('id_pasar', $request->segment(4))->get(),
            'pasar' => DB::table('pasar')->where('id_pasar', $request->segment(4))->get(),
            'id_pasar' => $request->segment(4)
        ];

        return view('admin/pasar/jampasar', $data)->with(['title' => 'Jam Operasional', 'sidebar' => 'Data Pasar']);

    }

    //--------------------------------------------------------------------------------------------------------------

    # Menampilkan laman data customers
    public function customers()
    {
        $customers = Users::orderByDesc('id_users')->get();
        return view('admin/customers/index', compact('customers'))->with(['title' => 'Data Customers', 'sidebar' => 'Data Customers']);
    }

    # Menampilkan laman tambah customers
    public function addcustomers(){
        
        return view('admin/customers/add')->with(['title' => 'Tambah Customers', 'sidebar' => 'Data Customers']);
    }

    # Menampilkan laman edit customers
    public function editcustomers(Request $request){
        
        $data = [
            'customers' => Users::where('id_users', $request->segment('5'))->get(),
            'pasar' => DB::table('pasar')->get(),
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'penjual.id_pasar', '=', 'pasar.id_pasar')->where('users.id_users', $request->segment(5))->get(),
            'id_users' => $request->segment(5)
        ];
        
        return view('admin/customers/edit', $data)->with(['title' => 'Edit Customers', 'sidebar' => 'Data Customers']);

    }

    //--------------------------------------------------------------------------------------------------------------

    # menampilkan laman data seller
    public function sellers(){

        # join 3 tabel (users, penjual, pasar)
        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'pasar.id_pasar', '=', 'penjual.id_pasar')->orderBy('penjual.id_penjual', "DESC")->get()
        ];
        return view('admin/sellers/index', $data)->with(['title'=> 'Data Sellers', 'sidebar' => 'Data Sellers']);

    }

    # menampilkan laman edit seller
    public function editsellers(Request $request){

        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'penjual.id_pasar', '=', 'pasar.id_pasar')->where('penjual.id_penjual', $request->segment(5))->get(),
            'pasar' => DB::table('pasar')->get(),
        ];

        return view('admin/sellers/edit', $data)->with(['title'=> 'Edit Sellers', 'sidebar' => 'Data Sellers']);

    }

    //-----------------------------------------------------------------------------------------------------------

    # Menampilkan data sellers di laman produk
    public function product(){

        # join 3 tabel (users, penjual, pasar)
        $data = [
            'sellers' => DB::table('users')->join('penjual', 'users.id_users', '=', 'penjual.id_users')->join('pasar', 'pasar.id_pasar', '=', 'penjual.id_pasar')->orderBy('penjual.id_penjual', "DESC")->get(),
            'pasar' => DB::table('pasar')->get(),
        ];
        return view('admin/produk/index', $data)->with(['title'=> 'Data Produk', 'sidebar' => 'Data Produk']);

    }

    # menampilkan laman detail seller / toko
    public function listproduk(){

        return view('admin/produk/list')->with(['title'=> 'List Produk', 'sidebar' => 'Data Produk']);

    } 


}
