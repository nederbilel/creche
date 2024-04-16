<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

use Closure;
use Illuminate\Http\Request;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   
     public function handle(Request $request, Closure $next)
     {
         if (Auth::check() && Auth::user()->usertype === 'admin') {
             return $next($request);
         }
     
         return redirect()->route('login');
        }
     
        
    
}
