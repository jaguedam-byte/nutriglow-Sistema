<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'login',
            'logout',
        ]);

        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));
        $middleware->redirectUsersTo(fn (Request $request) => route('panel'));

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'session.version' => \App\Http\Middleware\EnsureSessionVersionIsValid::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (TokenMismatchException $exception, Request $request): RedirectResponse {
            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'La sesion expiro. Ingresa nuevamente para continuar.',
                ]);
        });
    })->create();
