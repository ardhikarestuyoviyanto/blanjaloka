<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionAdmin
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
        if (!$request->session()->exists('isAdmin')) {
            # Jika tidak ada SESSION['isAdmin'] maka, teredirect ke laman login admin
            return redirect('auth/admin');
        }
        return $next($request);
    }
}
