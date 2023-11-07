<?php

use App\Http\Controllers\HobbyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Control\AdminController;

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

Route::get('/edit-profile', [RegisterController::class,'editProfile'])
    ->name('profile.edit');

Route::put('/update-profile', [RegisterController::class,'updateProfile'])
    ->name('profile.update');


// Hobby routes

Route::get('/hobby', [HobbyController::class,'index'])
    ->name('hobby.index');

Route::get('/hobby/create', [HobbyController::class,'create'])->name('hobby.create');

Route::post('/hobby', [HobbyController::class,'store'])->name('hobby.store');

// Admin routes

Route::middleware(['role:admin'])->group(function(){
    Route::get('/control', [AdminController::class, 'index'])->name('admin.index');
});

