<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Users;

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

# halaman admin
Route::get('/admin', [App\Http\Controllers\Admin::class, 'index']);
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
Route::get('auth/loginadmin', [Auth::class, 'adminlogin']);

//---------------------------------------------------------------------
# Login Berhasil
Route::get('/index', [Users::class, 'index'])->middleware('sessionusers');

