<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;

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

