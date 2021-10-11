<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists('isUsers')) {
            # Jika tidak ada SESSION['isUsers'] maka, teredirect ke laman landingpage 
            return redirect('/');
        }
        return $next($request);
    }
}
