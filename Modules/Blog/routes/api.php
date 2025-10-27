<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

Route::prefix('v1')->group(function () {

    Route::get('blogs', [BlogController::class, 'index']);
    Route::get('blogs/{id}', [BlogController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('blogs', [BlogController::class, 'store']);
    });

});
