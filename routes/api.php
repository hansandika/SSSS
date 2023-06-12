<?php

use App\Http\Controllers\Api\ApiTokenController;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::put("/api_token", [ApiTokenController::class, 'update'])->name('api_token.update');

Route::post('/comment-likes', [LikeController::class, 'updateCommentLike'])->name('comments.update');
Route::post('/post-likes', [LikeController::class, 'updatePostLike'])->name('likes.update');
