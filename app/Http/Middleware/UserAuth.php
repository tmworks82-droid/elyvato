<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    
    public function handle(Request $request, Closure $next): Response
    {
        // if (!auth()->check() || auth()->user()->type !== 'customer' || auth()->user()->type !== 'user') {
        //     // dd(Auth::user()->name);
        //     return redirect()->route('user_login_form');
        // }

         if (!auth()->check() || !in_array(auth()->user()->type, ['customer', 'user'])) {
                return redirect()->route('user_login_form');
            }

        return $next($request);
    }
}
