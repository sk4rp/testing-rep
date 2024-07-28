<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;


Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/store', [PostController::class, 'store']);
    Route::get('/show/{id}', [PostController::class, 'show']);
    Route::put('/update/{id}', [PostController::class, 'update']);
    Route::delete('/delete/{id}', [PostController::class, 'destroy']);
});
