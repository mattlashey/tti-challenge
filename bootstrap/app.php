<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle ValidationException
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                // Flatten all error messages into a single string
                $errorMessages = collect($e->errors())->flatten()->implode(', '); 
                return response()->json([
                    'status' => 'error',
                    'message' => $errorMessages,
                ], 422);
            }
        });
    })->create();
