<?php

use App\Http\Controllers\HobbyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Control\AdminController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Control\RoleController;

Route::get('/', [HomeController::class,'welcome'])
    ->name('index');

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [HomeController::class,'index'])
        ->name('home');

    Route::post('/logout', [LoginController::class,'logout'])
        ->name('logout');

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

// Hobby routes

Route::get('/hobby', [HobbyController::class,'index'])
    ->name('hobby.index');



// Admin routes

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/control', [AdminController::class, 'index'])->name('admin.index');

    Route::prefix('/control')->group(function(){

        // Users

        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/roles', [AdminController::class, 'roles'])->name('admin.roles');
        Route::get('/roles/{role}/permissions', [RoleController::class, 'editPermissions'])->name('admin.roles.permissions');
        Route::post('/roles/{role}/permissions', [RoleController::class, 'addPermissions'])->name('admin.roles.permissions.add');

        // Hobbies

        Route::get('/hobbies', [AdminController::class, 'hobbies'])->name('admin.hobbies');
        Route::get('/hobby/create', [HobbyController::class,'create'])->name('admin.hobby.create');
        Route::post('/hobby', [HobbyController::class,'store'])->name('admin.hobby.store');

        // Tags
        Route::get('/tags', [AdminController::class, 'tags'])->name('admin.tags');
        Route::get('/tags/create', [TagController::class,'create'])->name('admin.tag.create');
        Route::post('/tags', [TagController::class,'store'])->name('admin.tag.store');
    });
});

