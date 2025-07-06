<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class Friends
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $from = Auth::user();
        $toId = $request->route('listemessages');
        if (!Gate::allows('envoyer-message', $toId)) {
            return redirect()->back()->withErrors(['Vous ne pouvez pas envoyer de message à cette personne.']);
        }
        return $next($request);
    }
}
