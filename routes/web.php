<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\Auth;

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
# aktifasi akun users handler
Route::get('verification/{id}', [Auth::class, 'usersverification']);

# halaman admin
Route::get('/admin', [App\Http\Controllers\Admin::class, 'index']);