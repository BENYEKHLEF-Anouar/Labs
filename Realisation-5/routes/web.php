<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/article/{id}', [PublicController::class, 'detail'])->name('article.detail');
Route::get('/favorites', [PublicController::class, 'favorites'])->name('favorites');
Route::post('/article/{id}/comment', [PublicController::class, 'storeComment'])->name('article.comment');

// Article update route
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');

// Admin article routes
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

