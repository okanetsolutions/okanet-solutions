<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class)->except('show');
});
