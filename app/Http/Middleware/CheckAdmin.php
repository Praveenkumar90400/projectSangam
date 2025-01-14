<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$adminIds)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user's admin_id is in the allowed list of admin IDs
        if ($user && in_array($user->role_id, $adminIds)) {
            return $next($request);  // Allow access
        }

        // If the user is not authorized, return a 403 error
        return response()->json(['error' => 'Unauthorized access'], 403);
    }
}
