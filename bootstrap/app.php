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
        ->withMiddleware(function (Middleware $middleware) {
        // 1. Tambahkan pengecualian CSRF untuk sementara agar tidak 419
        $middleware->validateCsrfTokens(except: [
            '/login', 
        ]);

        // 2. Alias Spatie yang sudah kamu buat
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
