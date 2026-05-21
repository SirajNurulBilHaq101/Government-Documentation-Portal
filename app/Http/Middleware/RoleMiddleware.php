<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: role:admin | role:staff | role:viewer
     *
     * Hierarchy:
     *   admin  → can access admin, staff, viewer routes
     *   staff  → can access staff, viewer routes
     *   viewer → can access viewer routes only
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthenticated.');
        }

        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('sign-in')
                ->with('error', 'Your account has been deactivated. Please contact the administrator.');
        }

        // Admin always has full access
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Check if user's role is in the allowed roles
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        abort(403, 'You do not have permission to access this page.');
    }
}
