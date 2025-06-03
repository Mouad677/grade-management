<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            abort(403, 'Accès non autorisé.');
        }

        $userRole = $request->user()->role;
        
        // Vérifier si l'utilisateur a l'un des rôles autorisés
        if (!in_array($userRole, $roles)) {
            abort(403, 'Accès non autorisé.');
        }

        // Restrictions supplémentaires pour les assistants
        if ($userRole === 'assistant') {
            $route = $request->route()->getName();
            
            // Les assistants ne peuvent pas gérer les administrateurs et les assistants
            if (str_contains($route, 'admin.users') && 
                ($request->isMethod('post') || $request->isMethod('put'))) {
                $user = $request->route('user');
                if ($user && in_array($user->role, ['admin', 'assistant'])) {
                    abort(403, 'Les assistants ne peuvent pas gérer les administrateurs et les assistants.');
                }
            }

            // Les assistants n'ont pas accès aux logs
            if (str_contains($route, 'admin.logs')) {
                abort(403, 'Les assistants n\'ont pas accès aux logs.');
            }
        }

        return $next($request);
    }
}
