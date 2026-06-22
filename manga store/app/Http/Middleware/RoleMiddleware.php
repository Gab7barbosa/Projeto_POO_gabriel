<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // Check if user is active
        if (! $request->user()->active) {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Sua conta está inativa. Entre em contato com o administrador.',
            ]);
        }

        // Check if the user's role is in the allowed roles
        if (! in_array($request->user()->role, $roles)) {
            abort(403, 'Acesso não autorizado para a sua função.');
        }

        return $next($request);
    }
}
