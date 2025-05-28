<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            // Redirect or handle unauthorized access
            return redirect()->url('user/login');
        }

        // Check if the user is an user
        if (!$user->is_admin == 1) {
            return $next($request);
        }

        // Return a 403 Forbidden error for non-user users
        abort(403, 'Unauthorized action.');
    }
}
