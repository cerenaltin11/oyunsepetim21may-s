<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Check if user is authenticated and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }
        
        // Redirect non-admin users to home page
        return redirect('/')->with('error', 'Bu sayfaya erişim yetkiniz bulunmuyor.');
    }
}
