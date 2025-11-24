<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', \App\Http\Controllers\ArticleController::class);

