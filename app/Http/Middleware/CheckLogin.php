<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            if (auth()->user()->is_banned == 1) {
                auth()->logout();
                return redirect('/login')->withErrors(['email' => 'Your account has been banned.']);
            }
            return $next($request);
        }

        return response(view('partials.please-login'));
    }
}
