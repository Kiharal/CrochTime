<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            '/callback',
            '/api/setTable'
        ]);
        $middleware->redirectGuestsTo(function (Request $request){
            $middlewares = $request->route()?->gatherMiddleware() ?? [];

            return in_array('customer:guest', $middlewares) ?
                route('customer.login') :
                route('login');
        });

        $middleware->redirectUsersTo(function (Request $request){
            $middlewares = $request->route() ?->gatherMiddleware() ?? [];

            return in_array('customer:auth', $middlewares) ?
                route('launch') :
                route('task.index');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
