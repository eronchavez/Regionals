<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //

        $middleware->alias([
            'auth401' => \App\Http\Middleware\RequireAuth401::class,
            'admin401' => \App\Http\Middleware\RequireAdmin401::class,
            
        ]);

        


    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
