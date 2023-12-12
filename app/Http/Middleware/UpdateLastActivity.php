<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $current_time = now();
            $threshold = 1; // Time threshold in minutes

            // Cache key for the user's last_activity
            $cache_key = 'user_last_activity_' . $user->id;

            // Retrieve the user's last_activity from cache or set it to null if not found
            $last_activity = Cache::get($cache_key, null);

            // Check if the time difference between the current time and the last activity time is greater than the threshold
            if ($last_activity === null || $current_time->diffInMinutes($last_activity) >= $threshold) {
                // Update the user's last_activity and last_visited_url in the database
                $user->update([
                    'last_activity' => $current_time,
                    'last_visited_url' => $request->fullUrl(),
                ]);

                // Store the current time as the user's last_activity in cache
                Cache::put($cache_key, $current_time, 60 * 24); // Cache duration in minutes (e.g., 24 hours)
            }
        }

        return $next($request);
    }
}
