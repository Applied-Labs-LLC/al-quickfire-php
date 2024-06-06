<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Middleware\JsonifyMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([JsonifyMiddleware::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{productId}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{productId}', [ProductController::class, 'update']);
    Route::delete('/products/{productId}', [ProductController::class, 'delete']);

    Route::get('/products/{productId}/images', [ProductImageController::class, 'index']);
    Route::post('/products/{productId}/images', [ProductImageController::class, 'store']);
    Route::put('/products/{productId}/images/{imageId}', [ProductImageController::class, 'update']);
    Route::get('/products/{productId}/images/{imageId}', [ProductImageController::class, 'show']);
    Route::delete('/products/{productId}/images/{imageId}', [ProductImageController::class, 'delete']);

    Route::get('/products/{productId}/variants', [ProductVariantController::class, 'index']);
    Route::post('/products/{productId}/variants', [ProductVariantController::class, 'store']);
    Route::put('/products/{productId}/variants/{variantId}', [ProductVariantController::class, 'update']);
    Route::get('/products/{productId}/variants/{variantId}', [ProductVariantController::class, 'show']);
    Route::delete('/products/{productId}/variants/{variantId}', [ProductVariantController::class, 'delete']);
});
