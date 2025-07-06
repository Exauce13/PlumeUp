<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Suspendre
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_suspended == 1) {
            // Déconnecte l'utilisateur
            Auth::logout();

            // Invalide la session actuelle
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirige avec un message d'erreur
            return redirect()->route('login')->withErrors([
                'email' => 'Votre compte est suspendu. Contactez l’administrateur.',
            ]);
        }
        if (Auth::check()) {
            if (Auth::user()->statut === 'SuperAdmin') {
                return redirect('/SuperAdmin/admin');
            }
        }
        return $next($request);
    }
}
