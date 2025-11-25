<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/article/{id}', [PublicController::class, 'detail'])->name('article.detail');
Route::get('/favorites', [PublicController::class, 'favorites'])->name('favorites');
Route::post('/article/{id}/comment', [PublicController::class, 'storeComment'])->name('article.comment');
