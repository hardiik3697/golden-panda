<?php

use App\Providers\RolePermissionProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booting(function (Application $app) {
        // Register MiddlewareServiceProvider here
        $app->register(RolePermissionProvider::class);
        $app->singleton('home_route', fn () => env('APP_HOME', '/dashboard'));
    })
    ->create();
