<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/productos', 'pages.products')->name('products');
Route::view('/productos/okaisp', 'pages.okaisp')->name('products.okaisp');
Route::view('/productos/okastore', 'pages.okastore')->name('products.okastore');
Route::view('/desarrollo-a-medida', 'pages.development')->name('development');
Route::view('/ciberseguridad', 'pages.security')->name('security');
Route::view('/nosotros', 'pages.about')->name('about');
Route::view('/contacto', 'pages.contact')->name('contact');
Route::view('/privacidad', 'pages.privacy')->name('privacy');
Route::view('/cookies', 'pages.cookies')->name('cookies');
Route::view('/terminos-y-condiciones', 'pages.terms')->name('terms');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class)->except('show');
});
