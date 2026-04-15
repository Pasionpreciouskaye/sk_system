<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    /**
     * Usage: ->middleware('role:super_admin,treasurer')
     * Passes if user has ANY of the listed roles.
     */
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->isSuperAdmin() || \in_array($user->role, $roles)) {
            return $next($request);
        }

        Log::channel('security')->warning('Unauthorized role access attempt', [
            'user_id' => $user->id,
            'email'   => $user->email,
            'role'    => $user->role,
            'path'    => $request->path(),
            'ip'      => $request->ip(),
        ]);

        abort(403, 'You do not have permission to access this page.');
    }
}
