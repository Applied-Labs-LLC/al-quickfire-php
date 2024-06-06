<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception) {
            return response()->json([
                'error' => true,
                'message' => 'Page not found'
            ], 404);
        });
        $exceptions->render(function (UninitializedContextException $exception) {
            return response()->json([
                'error' => true,
                'message' => 'Shopify connection instance has not been configured properly'
            ], 500);
        });

        $exceptions->render(function (JsonException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while parsing JSON, see logs'
            ], 500);
        });

        $exceptions->render(function (ClientExceptionInterface $exception) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to make a request to a Shopify API',
                'reason' => $exception->getMessage()
            ], 400);
        });

        $exceptions->render(function (AccessDeniedHttpException $exception) {
            return response()->noContent(403);
        });
    })->create();
