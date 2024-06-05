<?php


use App\Http\Controllers\ProductController;
use App\Http\Middleware\JsonifyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([JsonifyMiddleware::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);
});
