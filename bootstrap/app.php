<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Middleware;
use App\Http\Middleware\JsonResponseMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function ($exceptions) {

        $exceptions->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, $request) {
            if ($request->wantsJson()) {
                return Response::json([
                    'message' => 'Resource not found',
                    'error' => 'The requested resource could not be found.'
                ], 404);
            }
        });

        $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->wantsJson()) {
                return Response::json([
                    'message' => 'Resource not found',
                    'error' => 'The requested resource could not be found.'
                ], 404);
            }
        });


        $exceptions->renderable(function (\Exception $e, $request) {
            if ($request->wantsJson()) {
                return Response::json([
                    'message' => 'Internal Server Error',
                    'error' => 'An unexpected error occurred.'
                ], 500);
            }
        });
    })
    ->create();

