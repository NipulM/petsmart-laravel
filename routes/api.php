<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OrdersController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Categories routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'getAllCategories']);
        Route::get('/{id}', [CategoryController::class, 'getCategoryById']);
        Route::post('/', [CategoryController::class, 'createNewCategory']);
    });

    // Products routes
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'getAllProducts']);
        Route::get('/new', [ProductController::class, 'getNewProducts']);
        Route::get('/filter', [ProductController::class, 'filterProducts']);
        Route::get('/{id}', [ProductController::class, 'getProductById']);
        Route::post('/', [ProductController::class, 'createProduct']);
        Route::put('/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
    });

    Route::post('/orders', [OrdersController::class, 'store']);
});
