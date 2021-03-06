<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // Middlewhare exclusivo para usuarios, si no se es usuario registrado o admin devuelve a home
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && (auth()->user()->role == "user" || auth()->user()->role == "admin")) {
            return $next($request);
    } else {
        return redirect('/');
    }
    }
}
