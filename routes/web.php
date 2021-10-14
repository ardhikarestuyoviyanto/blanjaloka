<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Users;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Customers;

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
    Route::get('pasar', [Admin::class, 'pasar'])->middleware('sessionadmin');
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
    });
});

//---------------------------------------------------------------------
# Login Berhasil Penjual & Pembeli
Route::get('/index', [Users::class, 'index'])->middleware('sessionusers');

