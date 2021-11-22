<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;

class PinVerificationSellers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){

        if(!empty($request->session()->get('pin'))){

            return $next($request);

        }else

        if($this->IfSellersContainsPin($request)){

            if($request->isMethod('post')){

                if($this->validationPin($request)){
                    
                    session(['pin'=>true]);

                    return redirect($request->getRequestUri());
                    
                }else{

                    # Kembali ke laman verifikasi Pin dengan pesan error
                    return response()->view('sellers/auth/pinverification', ['title' => 'Verifikasi PIN', 'sidebar' => 'Verifikasi PIN', 'route'=>$request->getRequestUri(), 'error'=> "Pin Penjual Salah"]);

                }
    
            }else{
    
                # Redirect ke Laman Verifikasi Pin
                return response()->view('sellers/auth/pinverification', ['title' => 'Verifikasi PIN', 'sidebar' => 'Verifikasi PIN', 'route'=>$request->getRequestUri()]);
    
            }

        }else{

            # Redirect ke Laman Create Pin
            return response()->view('sellers/auth/createpin', ['title' => 'Buat PIN Penjual', 'sidebar' => 'Verifikasi PIN', 'route'=>$request->getRequestUri()]);

        }


    }

    public function IfSellersContainsPin(Request $request){

        $seller = Seller::where('id_penjual', $request->session()->get('id_penjual'))->get();

        foreach($seller as $s){

            if(empty($s->pin)){

                return false;
    
            }else{
    
                return true;
    
            }

        }

    }

    public function validationPin(Request $request){

        $seller = Seller::where('id_penjual', $request->session()->get('id_penjual'))->get();

        foreach ($seller as $s){

            if($s->pin == $request->post('pin')){

                return true;
    
            }else{
    
                return false;
    
            }

        }

    }

}
