<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
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
    
    Route::get('/home', [HomeController::class, "home"])->name('auth.home');
    Route::get('/logout', [LoginController::class, "logout"])->name('auth.logout');

    Route::get('/email/verify', [EmailVerificationController::class, "verifyEmail"])->name('verification.notice');
    Route::get('/email/verification-notification', [EmailVerificationController::class, "verifyEmailSend"])->name('verification.send');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, "confirmEmail"])
        ->middleware('signed')->name('verification.verify');
});
