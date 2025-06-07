<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Auth\TokenController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionBoxController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProducts']);
    Route::get('/new', [ProductController::class, 'getNewProducts']);
    Route::get('/filter', [ProductController::class, 'filterProducts']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'getAllBlogPosts']);
    Route::get('/{id}', [BlogController::class, 'getBlogPostById']);
});

Route::prefix('subscriptions')->group(function () {
    Route::get('/', [SubscriptionController::class, 'getAllSubscriptions']);
    Route::get('/{id}', [SubscriptionController::class, 'getSubscriptionById']);
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);

    // Categories routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'getAllCategories']);
        Route::get('/{id}', [CategoryController::class, 'getCategoryById']);
        Route::post('/', [CategoryController::class, 'createNewCategory']);
    });

    // Products routes
    Route::prefix('products')->group(function () {
        Route::put('/{id}', [ProductController::class, 'updateProduct']);
        Route::post('/', [ProductController::class, 'createProduct']);
        Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
    });

    // Blog routes
    Route::prefix('blogs')->group(function () {
        Route::post('/', [BlogController::class, 'createBlogPost']);
    });

    // Subscriptions routes
    Route::prefix('subscriptions')->group(function () {
        Route::post('/', [SubscriptionController::class, 'createSubscription']);
    });

    // subscription box routes
    Route::prefix('subscription-boxes')->group(function () {
        Route::get('/', [SubscriptionBoxController::class, 'getSubscriptionBoxesByUserId']);
        Route::get('/', [SubscriptionBoxController::class, 'getSubscriptionBoxesByUserId']);
    });

    Route::post('/orders', [OrdersController::class, 'store']);
    Route::get('/orders', [OrdersController::class, 'getUserOrders']);

    Route::post('/token/regenerate', [TokenController::class, 'regenerate'])->name('token.regenerate');
});
