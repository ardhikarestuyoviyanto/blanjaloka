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

        return view('admin/pasar/index')->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);

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


}
