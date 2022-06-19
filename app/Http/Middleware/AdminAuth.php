<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // Middlewhare exclusivo para admins, si no se es admin devuelve a home
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->role == "admin") {
                return $next($request);
        } else {
            return redirect('/home');
        }

    }
}
