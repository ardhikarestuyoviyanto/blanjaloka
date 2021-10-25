<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mews\Captcha\Captcha;
use Illuminate\Support\Facades\DB;

use App\Models\Users;
use App\Models\Admin;
use App\Mail\EmailVerification;
use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\Session;

class Auth extends Controller
{
    # menampilkan halaman login users
    public function userslogin()
    {

        return view('web/auth/login')->with(['title' => 'Login']);
    }

    # menampilkan halaman register users
    public function usersregister()
    {

        return view('web/auth/register')->with(['title' => 'Register']);
    }

    # proses handler registrasi users
    public function usersregister_handler(Request $request)
    {

        # Validator
        $validator = Validator::make($request->all(), [
            'nama_user' => ['required', 'max:100'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', Password::min(6)->mixedCase()->numbers()->letters()]
        ]);

        # If Else Apabila Validasi Salah dan Benar
        if ($validator->fails()) {

            # Jika Validasi Salah, Redirect ke halaman registrasi dengan pesan error
            return redirect('register')->withErrors($validator)->withInput();
        } else {

            # Jika Validasi Berhasil Maka
            $data = [
                'nama_user' => $request->post('nama_user'),
                'email' => $request->post('email'),
                'password' => password_hash($request->post('password'), PASSWORD_DEFAULT),
                'status' => 'off'
            ];

            # Insert Data Tabel Users
            Users::create($data);

            try{

                # Buat Token Aktifasi Email
                $token = Str::random(15);
                $request->session()->put(['token' => $token]);

                # Kirim Link Aktifasi Akun, Lewat Email
                Mail::to($request->post('email'))->send(new EmailVerification(['email'=>$request->post('email'), 'nama_user'=>$request->post('nama_user'), 'token'=>$token]));

            }catch(Exception $e){

                # Tampilkan pesan error
                dd($e->getMessage());

            }

            # Redirect ke halaman registrasi dengan pesan sukses
            return redirect('register')->with('success', 'Kami telah mengirimkan link aktifasi akun anda ke email ' . $request->post('email'));
        }
    }

    # proses aktifasi akun users
    public function usersverification(Request $request)
    {
        try{

            # Cocokkan token
            if($request->session()->get('token') == $request->segment(3)){

                # Update Status Akun off -> on
                Users::where('email', $request->segment(2))->update(['status' => 'on']);

                # Delete token
                $request->session()->flush();

                # Redirect ke halaman login dengan pesan sukses
                return redirect('login')->with('success', 'Selamat Akun anda Berhasil di Aktifasi');

            }else{

                echo 'Token verifikasi salah, silahkan coba lagi';

            }

        }catch(Exception $e){

            # Tampilkan Pesan Error
            dd($e->getMessage());
        }


    }

    # Login Manual
    public function userslogin_handler(Request $request){

        # Validator
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        # if else validator salah atau benar
        if($validator->fails()){

            # jika validasi error kembali ke laman users login dengan pesan error
            return redirect('login')->withErrors($validator);

        }

        $data = [
            'email' => $request->post('email'),
            'password' => $request->post('password'),
            'status' => 'on'
        ];

        if(\Illuminate\Support\Facades\Auth::attempt($data)){

            # Dapatkan data users
            $isUser = Users::where('email', $request->post('email'))->first();

            # set session
            $session = array(
                'isUsers' => true,
                'id_users' => $isUser->id_users,
                'nama_user' => $isUser->nama_user
            );
            
            # simpan session
            $request->session()->put($session);

            # redirect ke laman dashboard pembeli
            return redirect('index');

        }else{

            # Redirect ke halaman login dengan pesan error
            return redirect('login')->with('error', 'Email atau Password Salah');

        }


    }

    # jika login / register via google di klik
    public function google(){

        # google auth redirect
        return Socialite::driver('google')->redirect();

    }

    # callback google
    public function google_callback(Request $request){

        try{

            $user = Socialite::driver('google')->user();

            # cek di tabel users apakah value di kolom google_id sudah ada, atau belum
            $isUser = Users::where('google_id', $user->id)->first();

            # jika sudah ada, redirect ke halaman dashboard users (Berhasil Login)
            if($isUser){

                # set session
                $session = array(
                    'isUsers' => true,
                    'id_users' => $isUser->id_users,
                    'nama_user' => $isUser->nama_user
                );

                # simpan session
                $request->session()->put($session);

                # redirect ke laman dashboard pembeli
                return redirect('index');

            }else{

                # Jika kolom google_id di tabel users masih null value nya, registerkan secara otomatis
                # Get Email dari Google
                if($user->getEmail() != null){

                    # Cek email users udah pernah registrasi atau belum
                    $cekusers = Users::where('email', $user->getEmail())->get();
                    
                    if($cekusers->count() > 0){

                        # Jika email telah didaftarakan, tambahkan google_id
                        Users::where('email', $user->getEmail())->update(['google_id'=>$user->getId()]);

                    }else{

                        # Jika Email sama sekali belum pernah didaftarkan Lakukan Registrasi Otomatis
                        $data = array(
                            'nama_user' => $user->getName(),
                            'email' => $user->getEmail(),
                            'password' => password_hash(rand(0, 1000), PASSWORD_DEFAULT),
                            'status' => 'on',
                            'google_id' => $user->getId()
                        );

                        # Tambah Akun Users Baru
                        Users::create($data);

                    }

                    # Dapatkan data users
                    $isUser = Users::where('google_id', $user->id)->first();

                    # set session
                    $session = array(
                        'isUsers' => true,
                        'id_users' => $isUser->id_users,
                        'nama_user' => $isUser->nama_user
                    );
                    
                    # simpan session
                    $request->session()->put($session);

                    # redirect ke laman dashboard pembeli
                    return redirect('index');

                } 

            }

        }catch(Exception $e){

            # Tampilkan pesan error
            dd($e->getMessage());

        }

    }

    # Login dan Register via facebook
    public function facebook(){

        return Socialite::driver('facebook')->redirect();
    }

    # callback facebook
    public function facebook_callback(Request $request){

        try{

            $user = Socialite::driver('facebook')->user();

            # cek di tabel users apakah value di kolom facebook_id sudah ada, atau belum
            $isUser = Users::where('facebook_id', $user->id)->first();

            # jika sudah ada, redirect ke halaman dashboard users (Berhasil Login)
            if($isUser){

                # set session
                $session = array(
                    'isUsers' => true,
                    'id_users' => $isUser->id_users,
                    'nama_user' => $isUser->nama_user
                );

                # simpan session
                $request->session()->put($session);

                # redirect ke laman dashboard pembeli
                return redirect('index');

            }else{

                # Jika kolom facebook_id di tabel users masih null value nya, registerkan secara otomatis
                # Get Email dari Facebook
                if($user->getEmail() != null){

                    # Cek email users udah pernah registrasi atau belum
                    $cekusers = Users::where('email', $user->getEmail())->get();
                    
                    if($cekusers->count() > 0){

                        # Jika email telah didaftarakan, tambahkan google_id
                        Users::where('email', $user->getEmail())->update(['facebook_id'=>$user->getId()]);

                    }else{

                        # Jika Email sama sekali belum pernah didaftarkan Lakukan Registrasi Otomatis
                        $data = array(
                            'nama_user' => $user->getName(),
                            'email' => $user->getEmail(),
                            'password' => password_hash(rand(0, 1000), PASSWORD_DEFAULT),
                            'status' => 'on',
                            'facebook_id' => $user->getId()
                        );

                        # Tambah Akun Users Baru
                        Users::create($data);

                    }

                    # Dapatkan data users
                    $isUser = Users::where('facebook_id', $user->id)->first();

                    # set session
                    $session = array(
                        'isUsers' => true,
                        'id_users' => $isUser->id_users,
                        'nama_user' => $isUser->nama_user
                    );
                    
                    # simpan session
                    $request->session()->put($session);

                    # redirect ke laman dashboard pembeli
                    return redirect('index');

                } 

            }

        }catch(Exception $e){

            # Tampilkan pesan error
            dd($e->getMessage());

        }
    }

    # menampilkan halaman login admin
    public function adminlogin(){

        return view('admin/auth/login');

    }

    # handler login admin
    public function adminlogin_handler(Request $request){

        # Set pesan error captcha salah
        $messages = [
            'captcha.captcha' => 'Captcha Wrong',
        ];

        # Validator
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'email'],
            'password' => ['required'],
            'captcha' => ['required', 'captcha']
        ], $messages);

        # if else validator salah atau benar
        if($validator->fails()){

            # jika validasi error kembali ke laman login admin dengan pesan error
            return redirect('auth/admin')->withErrors($validator);

        }

        # cek data admin
        $admin = Admin::where('email', $request->post('email'))->get();

        # cek apakah email admin ada atau tidak
        if(empty(count($admin))){

            # Email tidak ada
            # Redirect ke halaman login admin dengan pesan error
            return redirect('auth/admin')->with('error', 'Email atau Password Salah');


        }else{

            # Email ditemukan, cek password benar atau salah
            foreach ($admin as $x){

                if(password_verify($request->post('password'), $x->password)){

                    # password ditemukan
                    # set session
                    $session = array(
                        'isAdmin' => true,
                        'id_admin' => $x->id_admin,
                        'nama' => $x->nama_admin
                    );
                    
                    # simpan session
                    $request->session()->put($session);

                    # redirect ke laman dashboard pembeli
                    return redirect('admin');

                }

                # Password Salah
                # Redirect ke halaman login admin dengan pesan error
                return redirect('auth/admin')->with('error', 'Email atau Password Salah');

            }

        }

    }

    # Menampilkan laman register penjual
    public function sellers(Request $request){

        # Cek customers terdaftar sebagai sellers / belum
        if(count(DB::table('penjual')->where('id_users', $request->session()->get('id_users'))->get()) == 1){

            # Sudah Terdaftar
            # Redirect Ke Laman Dashboard Sellers
            # Add Variabel New Sessions
            $sellers = DB::table('penjual')->where('id_users', $request->session()->get('id_users'))->get();
            foreach ($sellers as $s){

                $request->session()->push('id_penjual', $s->id_penjual);

            }

            # Redirect laman dashboard sellers

            if(Session::get('success')){

                return redirect('sellers')->with('success', "Pendaftaran Anda Sebagai Sellers Berhasil, Selamat Berjualan :)");

            }else{

                return redirect('sellers');

            }


        }else{

            # Belum Terdaftar
            # Redirect Ke Laman Pendaftaran Sellers
            $data = [
                'id_users' => $request->segment(3),
                'customers' => DB::table('users')->where('id_users', $request->session()->get('id_users'))->get(),
                'kategoritoko' => DB::table('kategoritoko')->get(),
                'pasar' => DB::table('pasar')->get()
            ];

            return view('sellers/auth/register', $data)->with(['title' => 'Daftar Akun Sellers']);;

        }

    }

    # Register Sellers Handler
    public function sellersregister_handler(Request $request){

        # Validator
        $validator = Validator::make($request->all(), [
            'no_ktp' => ['required', 'digits:16'],
            'foto_ktp' => 'mimes:jpeg,jpg,png,PNG,JPEG,JPG',
            'foto_penjual_ktp' => 'mimes:jpeg,jpg,png,PNG,JPEG,JPG',
        ]);

        if($validator->fails()){

            return redirect('sellers/daftar')->withErrors($validator)->withInput();

        }else{

            try{

                if($request->hasFile('foto_ktp') && $request->hasFile('foto_penjual_ktp')){

                    $foto_ktp = $request->file('foto_ktp');
                    $foto_penjual_ktp = $request->file('foto_penjual_ktp');

                    $namafile_foto_ktp = time().'_'.$foto_ktp->getClientOriginalName();
                    $namafile_foto_penjual_ktp = time().'_'.$foto_penjual_ktp->getClientOriginalName();

                    $foto_ktp->move('assets/admin/foto_ktp', $namafile_foto_ktp);
                    $foto_penjual_ktp->move('assets/admin/foto_penjual_ktp', $namafile_foto_penjual_ktp);

                    $data = [
                        'status' => 'on',
                        'id_users' => $request->session()->get('id_users'),
                        'id_pasar' => $request->post('id_pasar'),
                        'nama_toko' => $request->post('nama_toko'),
                        'alamat_toko' => $request->post('alamat_toko'),
                        'no_ktp' => $request->post('no_ktp'),
                        'foto_ktp' => $namafile_foto_ktp,
                        'foto_penjual_ktp' => $namafile_foto_penjual_ktp,
                        'id_kategoritoko' => $request->post('id_kategoritoko')
                    ];

                    Seller::create($data);

                    return redirect('sellers/daftar')->with('success', "Pendaftaran Anda Sebagai Sellers Berhasil, Selamat Berjualan :)");

                }

            }catch(Exception $e){

                # Tampilkan pesan error
                dd($e->getMessage());
    
            }

        }

    }

    # Logout Semua Akun
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

}
