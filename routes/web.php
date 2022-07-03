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
Route::get('/', [SiteController::class, "index"])->name('index');
Route::get('/login', [SiteController::class, "login"])->name('login'); 
Route::post('/login', [SiteController::class, "authenticate"])->name('auth');
Route::get('/register', [SiteController::class, "register"])->name('register');
Route::post('/register', [SiteController::class, "createUser"])->name('create.user');

Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, "index"])->name('auth.home');
    Route::get('/logout', [UserController::class, "logout"])->name('auth.logout');
});