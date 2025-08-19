<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Allow login + logout + password reset routes to bypass
        if ($request->routeIs([
            'filament.admin.auth.login',
            'filament.admin.auth.logout',
            'filament.admin.auth.password.*', // reset, forgot, etc.
        ])) {
            return $next($request);
        }

        $user = Auth::user();

        if (! $user) {
            return redirect()->route('filament.admin.auth.login');
        }

        if (! collect($user->getRoleNames())->map(fn($r) => strtolower($r))->intersect(['admin', 'super admin'])->isNotEmpty()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
