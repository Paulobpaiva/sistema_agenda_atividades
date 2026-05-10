<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAtivoMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && !$request->user()->isAtivo()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Seu usuário está desativado. Procure o administrador.',
                ]);
        }

        return $next($request);
    }
}