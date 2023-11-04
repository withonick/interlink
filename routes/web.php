<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', [HomeController::class,'index'])
    ->name('home');

Route::get('/register', [RegisterController::class,'create'])
    ->name('register.form');
Route::post('/register', [RegisterController::class,'register'])
    ->name('register');

Route::get('/login', [LoginController::class,'create'])
    ->name('login.form');

Route::post('/login', [LoginController::class,'login'])
    ->name('login');

Route::get('/logout', [LoginController::class,'logout'])
    ->name('logout');
