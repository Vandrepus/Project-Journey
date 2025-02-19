<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EnsureUserIsNotBanned;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'notBanned' => EnsureUserIsNotBanned::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle 401 Unauthorized
        $exceptions->render(function (AuthenticationException $e, $request) {
            return response()->view('errors.401', [], 401);
        });

        // Handle 403 Forbidden
        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            return response()->view('errors.403', [], 403);
        });

        // Handle 404 Not Found
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->view('errors.404', [], 404);
        });
    })->create();
