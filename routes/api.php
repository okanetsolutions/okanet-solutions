<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/token', [AuthController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('api.auth.token');

Route::get('/posts', [PostController::class, 'index'])->name('api.posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('api.posts.show');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user())->name('api.user');
    Route::delete('/auth/token', [AuthController::class, 'destroy'])->name('api.auth.logout');

    Route::post('/posts', [PostController::class, 'store'])->name('api.posts.store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('api.posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('api.posts.destroy');
});
