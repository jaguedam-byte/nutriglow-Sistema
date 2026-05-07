<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionVersionIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            return $next($request);
        }

        $sessionVersion = (int) $request->session()->get('auth_session_version', 1);
        $currentVersion = (int) ($user->session_version ?? 1);

        if ($sessionVersion !== $currentVersion) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Tu sesion fue cerrada por seguridad. Ingresa nuevamente.',
                ]);
        }

        return $next($request);
    }
}
