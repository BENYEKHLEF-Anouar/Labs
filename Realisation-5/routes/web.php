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

// Article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.delete');


// Admin article routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
});

