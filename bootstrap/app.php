<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

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
        // Handle ModelNotFoundException (wrapped in NotFoundHttpException)
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($e->getPrevious() instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Resource not found',
                ], 404);
            }
        });

         //Handle AuthenticationException (unauthenticated requests)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return response()->json([
                'message' => 'You must be logged in to access this resource',
            ], 401);
        });

        // Handle Validation errors
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, Request $request) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        });

        // Handle generic HTTP errors (403, 405, etc.)
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage() ?: 'HTTP error',
            ], $e->getStatusCode());
        });
        $exceptions->render(function (\Illuminate\Http\Exceptions\ThrottleRequestsException $e, Request $request) {
            return response()->json([
                'message' => 'Too many requests. Please slow down.',
            ], 429);
        });

        // Handle Method Not Allowed (405)
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Method not allowed',
            ], 405);
        });
        // Fallback for any unhandled exceptions
        $exceptions->render(function (\Throwable $e, Request $request) {
            return response()->json([
                'message' => 'Something went wrong on our server',
                'error'   => app()->hasDebugModeEnabled() ? $e->getMessage() : null, // show details only in debug
            ], 500);
        });

 })->create();
