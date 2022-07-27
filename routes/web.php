<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [SiteController::class, "index"])->name('index');

Route::get('/login', [LoginController::class, "login"])->name('login'); 
Route::post('/login', [LoginController::class, "authenticate"])->name('auth.login');

Route::get('/register', [UserController::class, "create"])->name('register');
Route::post('/register', [UserController::class, "store"])->name('create.user');

Route::get('/forgot-password', [ForgotPasswordController::class, "forgotPassword"])->name('password.notice');
Route::post('/forgot-password', [ForgotPasswordController::class, "forgotPasswordSendLink"])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, "reset"])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, "update"])->name('password.update');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [HomeController::class, "home"])->name('home');
    Route::get('/logout', [LoginController::class, "logout"])->name('logout');

    Route::get('/email/verify', [EmailVerificationController::class, "verifyEmail"])->name('verification.notice');
    Route::get('/email/verification-notification', [EmailVerificationController::class, "verifyEmailSend"])->name('verification.send'); 
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, "confirmEmail"])
        ->middleware('signed')->name('verification.verify');

    Route::prefix('user')->group(function () {
        Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/{id}/edit', [UserController::class, "update"])->name('user.update');
        Route::get('/{id}', [UserController::class, "show"])->name('user.show');
    });

   
    Route::resource('posts', PostController::class)->except([
        'index', 'destroy'
    ]);
    Route::get('/posts/{status}/list', [PostController::class, 'listPostedOrDraft'])->name('posts.list');
    Route::get('/posts/{id}/delete', [PostController::class, "destroy"])->name('posts.destroy');
});
