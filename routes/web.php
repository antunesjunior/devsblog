<?php

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

Route::get('/', [SiteController::class, "signin"])->name('signin');
Route::post('/signin', [SiteController::class, "auth"])->name('auth');

Route::middleware('auth')->group(function () {
    Route::get('/auth/home', [UserController::class, "index"])->name('auth.home');
    Route::get('/auth/logout', [UserController::class, "logout"])->name('auth.logout');
});