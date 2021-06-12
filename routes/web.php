<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;

Route::get('/', WelcomeController::class);

Route::get('categorias/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
