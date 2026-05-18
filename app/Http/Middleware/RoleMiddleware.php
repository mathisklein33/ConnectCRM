<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRoleSlug = Str::lower(trim($request->user()->role->slug));

        // admin accès total
        if ($userRoleSlug === 'admin') {
            return $next($request);
        }

        $allowedRoles = array_map(fn($r) => Str::lower(trim($r)), explode(',', $role));

        if (!in_array($userRoleSlug, $allowedRoles)) {
            abort(403, 'Accès interdit - Rôle requis : ' . $role);
        }

        return $next($request);
    }
}
