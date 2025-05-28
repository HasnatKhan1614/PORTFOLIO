<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
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
            return redirect()->url('admin/login');
        }

        // Check if the user is an admin
        if ($user->is_admin == 1) {
            return $next($request);
        }

        // Return a 403 Forbidden error for non-admin users
        abort(403, 'Unauthorized action.');
    }
}
