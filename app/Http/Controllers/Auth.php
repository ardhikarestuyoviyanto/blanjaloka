<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;

use App\Models\Users;
use App\Mail\EmailVerification;

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

            # Kirim Link Aktifasi Akun, Lewat Email
            Mail::to($request->post('email'))->send(new EmailVerification(['email' => $request->post('email'), 'nama_user' => $request->post('nama_user')]));

            # Redirect ke halaman registrasi dengan pesan sukses
            return redirect('register')->with('success', 'Kami telah mengirimkan link aktifasi akun anda ke email ' . $request->post('email'));
        }
    }

    # proses aktifasi akun users
    public function usersverification(Request $request)
    {

        # Update Status Akun off -> on
        Users::where('email', $request->segment(2))->update(['status' => 'on']);

        # Redirect ke halaman login dengan pesan sukses
        return redirect('login')->with('success', 'Selamat Akun anda Berhasil di Aktifasi');
    }
}
