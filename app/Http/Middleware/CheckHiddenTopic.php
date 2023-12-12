<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckHiddenTopic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $category = $request->route('category');
        $topic = $request->route('topic');
        $user = Auth::user();

        if ($topic->is_hidden && !$user->hasRole('admin')) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
