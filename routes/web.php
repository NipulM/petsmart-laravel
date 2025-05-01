<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/{product}', function ($product) {
    return view('products.show', [
        'product' => \App\Models\Product::findOrFail($product)
    ]);
})->name('products.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/subscription', [App\Http\Controllers\SubscriptionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('subscription');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('search');

Route::get('/about-us', [App\Http\Controllers\AboutusController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('about-us');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
