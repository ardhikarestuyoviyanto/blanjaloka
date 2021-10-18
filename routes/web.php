<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Users;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Customers;
use App\Http\Controllers\Sellers;
use App\Http\Controllers\Pasar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Homepage::class, 'index']);

# authentification users login and registers
Route::get('/login', [Auth::class, 'userslogin']);
Route::get('/register', [Auth::class, 'usersregister']);
# users register handler
Route::post('/usersregister', [Auth::class, 'usersregister_handler']);

# aktifasi email
Route::get('verification/{id}/{token}', [Auth::class, 'usersverification']);

#facebook
Route::get('auth/facebook', [Auth::class, 'facebook']);
Route::get('auth/facebook/callback', [Auth::class, 'facebook_callback']);

# Register / Login With Google
Route::get('auth/google', [Auth::class, 'google']);
Route::get('auth/google/callback', [Auth::class, 'google_callback']);

# users login handler
Route::post('/userslogin', [Auth::class, 'userslogin_handler']);

# Logout Semua Akun
Route::get('logout', [Auth::class, 'logout']);

# login admin
Route::get('auth/admin', [Auth::class, 'adminlogin']);
# admin login handler
Route::post('auth/adminlogin', [Auth::class, 'adminlogin_handler']);

//---------------------------------------------------------------------------------------
# Halaman admin
Route::prefix('admin')->group(function () {
    # Homepage Admin
    Route::get('/', [Admin::class, 'index'])->middleware('sessionadmin');
    # Pasar
    Route::prefix('pasar')->group(function () {
        Route::get('/', [Admin::class, 'pasar'])->middleware('sessionadmin');
        Route::get('add', [Admin::class, 'addpasar'])->middleware('sessionadmin');
        Route::post('addhandler', [Pasar::class, 'insertdatapasar'])->middleware('sessionadmin');
        Route::get('edit/{id}', [Admin::class, 'editpasar'])->middleware('sessionadmin');
        Route::post('edithandler', [Pasar::class, 'updatedatapasar'])->middleware('sessionadmin');
        Route::post('hapusfoto', [Pasar::class, 'deletefotopasar'])->middleware('sessionadmin');
        Route::post('deletehandler', [Pasar::class, 'deletepasar'])->middleware('sessionadmin');

        # jam operasional
        Route::get('jam/{id}', [Admin::class, 'jamoperasionalpasar'])->middleware('sessionadmin');
        Route::post('jam/insert', [Pasar::class, 'insertjamoperasionalpasar'])->middleware('sessionadmin');
        Route::post('jam/get', [Pasar::class, 'getjamoperasionalpasarbyid'])->middleware('sessionadmin');
        Route::post('jam/update', [Pasar::class, 'updatejamoperasionalpasar'])->middleware('sessionadmin');
        Route::post('jam/delete', [Pasar::class, 'deletejamoperasionalpasar'])->middleware('sessionadmin');

    });
    # Users Data
    Route::prefix('users')->group(function () {
        #Customers Data
        Route::get('customers', [Admin::class, 'customers'])->middleware('sessionadmin');
        Route::get('customers/add', [Admin::class, 'addcustomers'])->middleware('sessionadmin');
        Route::post('customers/addhandler', [Customers::class, 'insertcustomers'])->middleware('sessionadmin');
        Route::get('customers/edit/{id}', [Admin::class, 'editcustomers'])->middleware('sessionadmin');
        Route::post('customers/edithandler', [Customers::class, 'updatecustomers'])->middleware('sessionadmin');
        Route::post('customers/makesellers', [Customers::class, 'makesellers'])->middleware('sessionadmin');
        Route::post('customers/delete', [Customers::class, 'deletecustomers'])->middleware('sessionadmin');

        #Sellers Data
        Route::get('sellers', [Admin::class, 'sellers'])->middleware('sessionadmin');
        Route::post('sellers/delete', [Sellers::class, 'deleteakunsellers'])->middleware('sessionadmin');
        Route::get('sellers/edit/{id}', [Admin::class, 'editsellers'])->middleware('sessionadmin');
        Route::post('sellers/edithandler', [Sellers::class, 'updatesellers'])->middleware('sessionadmin');

    });
    # Master Produk
    Route::prefix('produk')->group(function () {
        # List Produk
        Route::get('/', [Admin::class, 'product'])->middleware('sessionadmin');
        Route::get('listproduk/{id}', [Admin::class, 'listproduk'])->middleware('sessionadmin');
    });
});

//---------------------------------------------------------------------
# Login Berhasil Penjual & Pembeli
Route::get('/index', [Users::class, 'index'])->middleware('sessionusers');
