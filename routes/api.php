<?php

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

Route::middleware('auth:api')->get('/likes', [LikeController::class, 'index'])->name('likes.index');

Route::middleware('auth:api')->post('/likes', [LikeController::class, 'store'])->name('likes.store');
