<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SecurityAssessmentController as AdminAssessmentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailScanController;
use App\Http\Controllers\SecurityAssessmentController;
use App\Http\Controllers\SecurityController;
use App\Http\Middleware\PrivateResponse;
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

Route::get('/login', [LoginController::class, 'show'])->middleware(PrivateResponse::class)->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware([PrivateResponse::class, 'throttle:5,1'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware([PrivateResponse::class, 'guest'])->group(function (): void {
    Route::get('/register', [RegistrationController::class, 'create'])->name('register');
    Route::post('/register', [RegistrationController::class, 'store'])->middleware('throttle:registration')->name('register.store');
    Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'store'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->middleware('throttle:5,1')->name('password.update');
});

Route::middleware([PrivateResponse::class, 'auth'])->group(function (): void {
    Route::get('/email/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'update'])
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'store'])
        ->middleware('throttle:3,1')->name('verification.send');
});

Route::middleware([PrivateResponse::class, 'auth', 'verified'])->prefix('ciberseguridad/mi-cuenta')->name('security.')->group(function (): void {
    Route::get('/', [SecurityController::class, 'index'])->name('dashboard');
    Route::post('/correo', [EmailScanController::class, 'store'])->middleware('throttle:3,60')->name('email.store');
    Route::post('/correo/{scan}/detalles', [EmailScanController::class, 'requestDetails'])->middleware('throttle:5,1')->name('email.details');
    Route::post('/dominios', [SecurityAssessmentController::class, 'store'])->middleware('throttle:5,60')->name('assessments.store');
    Route::get('/dominios/{assessment}', [SecurityAssessmentController::class, 'show'])->name('assessments.show');
    Route::post('/dominios/{assessment}/verificar', [SecurityAssessmentController::class, 'verify'])->middleware('throttle:5,1')->name('assessments.verify');
    Route::post('/dominios/{assessment}/renovar', [SecurityAssessmentController::class, 'renew'])->middleware('throttle:3,60')->name('assessments.renew');
    Route::post('/dominios/{assessment}/autorizar', [SecurityAssessmentController::class, 'authorizeAssessment'])->middleware('throttle:5,1')->name('assessments.authorize');
    Route::get('/dominios/{assessment}/informe', [SecurityAssessmentController::class, 'download'])->name('assessments.download');
    Route::post('/dominios/{assessment}/informe-completo', [SecurityAssessmentController::class, 'requestFullReport'])->middleware('throttle:5,1')->name('assessments.full-report');
});

Route::middleware([PrivateResponse::class, 'auth', 'can:staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class)->except('show');
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update']);
    Route::get('/evaluaciones', [AdminAssessmentController::class, 'index'])->name('assessments.index');
    Route::get('/evaluaciones/{assessment}', [AdminAssessmentController::class, 'show'])->name('assessments.show');
    Route::post('/evaluaciones/{assessment}/iniciar', [AdminAssessmentController::class, 'start'])->name('assessments.start');
    Route::post('/evaluaciones/{assessment}/informe', [AdminAssessmentController::class, 'upload'])->name('assessments.upload');
    Route::post('/evaluaciones/{assessment}/entregar', [AdminAssessmentController::class, 'deliver'])->middleware('throttle:5,1')->name('assessments.deliver');
    Route::get('/evaluaciones/{assessment}/informe', [AdminAssessmentController::class, 'download'])->name('assessments.download');
    Route::post('/evaluaciones/{assessment}/atendida', [AdminAssessmentController::class, 'completeReportFollowup'])->name('assessments.followup');
    Route::post('/consultas-correo/{scan}/atendida', [AdminAssessmentController::class, 'completeEmailFollowup'])->name('email.followup');
});
