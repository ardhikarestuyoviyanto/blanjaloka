<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class AuthFacebook extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function facebookcallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = Users::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('dashboard');
            } else {
                $newUser = Users::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
