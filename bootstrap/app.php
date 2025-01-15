<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Illuminate\Validation\ValidationException $validationException, $request) {
            // validation errors, not app errors
            $response = array(
                'error' => $validationException->getMessage(),
                'message' => "The input was malformed.",
                'data' => $request->body,
                'errors' => $validationException->errors(),
            );
            return response()->json($response, 400);
        });
        $exceptions->render(function (Exception $e, $request) {
            // misc errors
            $response = array(
                'error' => $e->getMessage(),
                'message' => "We're sorry, an error has occurred during this request.",
            );

            if (config('app.debug')) {
                $response['debug'] = array(
                    'class' => get_class($e),
                    'trace' => $e->getTrace(),
                );
            }

            return response()->json(
                $response,
                500,
            );
        });
    })->create();
