<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\TokenController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/products/{product}', function ($product) {
    return view('products.show', [
        'product' => \App\Models\Product::findOrFail($product)
    ]);
})->name('products.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/subscription', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/search/filter', [App\Http\Controllers\SearchController::class, 'filterProducts'])->name('search.filter');

Route::get('/about-us', [App\Http\Controllers\AboutusController::class, 'index'])->name('about-us');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/token/regenerate', [TokenController::class, 'regenerate'])->name('token.regenerate');

require __DIR__ . '/auth.php';
