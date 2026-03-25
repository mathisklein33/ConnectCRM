<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
        public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 💡 MODIFICATION ICI : On récupère le 'slug' de l'objet role
       $request->user()->role->slug;

        $userRoleData = $request->user()->role;

        // On extrait le slug (en gérant le cas où c'est un objet ou un tableau)
        $userRoleSlug = is_array($userRoleData) ? $userRoleData['slug'] : $userRoleData->slug;
        $userRoleSlug = Str::lower($userRoleSlug);

        // 👑 L'admin passe toujours
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
