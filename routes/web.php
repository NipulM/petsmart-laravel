<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/subscription', [App\Http\Controllers\SubscriptionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('subscription');

Route::get('/about-us', [App\Http\Controllers\AboutusController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('about-us');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
