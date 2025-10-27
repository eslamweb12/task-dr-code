<?php

use Illuminate\Support\Facades\Route;
use Modules\Like\Http\Controllers\LikeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/likes', [LikeController::class, 'store']);    // Add comment
});
