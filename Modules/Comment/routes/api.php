<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/comments', [CommentController::class, 'store']);    // Add comment
});