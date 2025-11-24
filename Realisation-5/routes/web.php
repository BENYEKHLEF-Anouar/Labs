<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicArticleController;

// Public routes
Route::get('/', [PublicArticleController::class, 'index'])->name('public.articles.index');
Route::get('/articles/{article}', [PublicArticleController::class, 'show'])->name('public.articles.show');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::resource('articles', ArticleController::class);
});

