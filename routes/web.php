<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class,'welcome'])
    ->name('index');

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class,'index'])
        ->name('home');
});


// Auth routes

Route::get('/register', [RegisterController::class,'create'])
    ->name('register.form');

Route::post('/register', [RegisterController::class,'register'])
    ->name('register');

Route::get('/login', [LoginController::class,'create'])
    ->name('login.form');

Route::post('/login', [LoginController::class,'login'])
    ->name('login');

Route::get('/login-email', [LoginController::class,'email'])
    ->name('login.emailForm');

Route::post('/login-email', [LoginController::class,'loginEmail'])
    ->name('login.email');

Route::post('/logout', [LoginController::class,'logout'])
    ->name('logout');

// Profile

Route::get('/profile', [HomeController::class,'profile'])
    ->name('profile.form');

Route::put('/profile', [HomeController::class,'profileChanges'])
    ->name('profile.update');
