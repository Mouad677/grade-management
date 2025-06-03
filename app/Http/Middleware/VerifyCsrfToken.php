<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin/grades/import',
        'admin/grades/upload',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Pour les requêtes longues, on vérifie et régénère la session
        if ($request->is('admin/grades/import') || $request->is('admin/grades/upload')) {
            return $next($request);
        }

        // Pour toutes les requêtes, vérifier si le token CSRF est valide
        if ($this->isReading($request) || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        $token = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');
        
        if (!$token || !$this->tokensMatch($request)) {
            throw new TokenMismatchException('CSRF token mismatch.');
        }

        return $next($request);
    }

        // Mettre à jour le timestamp de la session
        $request->session()->put('last_activity', time());

        // Régénérer l'ID de session pour plus de sécurité
        $request->session()->regenerate();
    }
}
