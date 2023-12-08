<?php

use App\Http\Controllers\HobbyController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Control\AdminController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Control\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StoryController;

Route::get('/login', [LoginController::class,'index'])
    ->name('login.form');

Route::post('/login', [LoginController::class,'login'])
    ->name('login');

Route::get('/', [HomeController::class,'index'])
    ->name('index');

Route::middleware(['auth', 'registration_completed'])->group(function(){

    Route::get('/home', [HomeController::class,'index'])
        ->name('home');

    Route::post('/logout', [LoginController::class,'logout'])
        ->name('logout');

    Route::get('/profile/{username}', [ProfileController::class, 'show'])
        ->name('user.show');

    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])
        ->name('user.edit');

    Route::post('/profile/{username}/images', [ProfileController::class, 'storeImages'])
        ->name('user.images.store');

    Route::delete('/profile/{username}/images/{image}', [ProfileController::class, 'deleteImage'])
        ->name('user.images.delete');

    Route::put('/profile/{username}', [ProfileController::class, 'update'])
        ->name('user.update');

    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat.index');

    Route::get('/chat/{username}', [ChatController::class, 'show'])
        ->name('chat.show');

    Route::post('/chat/{username}', [ChatController::class, 'store'])
        ->name('chat.store');

    Route::post('/like/{username}', [HomeController::class, 'like'])
        ->name('like');

    Route::post('/dislike/{username}', [HomeController::class, 'dislike'])
        ->name('dislike');

    Route::get('/matches', [HomeController::class, 'matches'])
        ->name('matches.index');

    Route::post('/matches/{username}', [HomeController::class, 'matchAccept'])
        ->name('matches.accept');

    Route::delete('/matches/{username}', [HomeController::class, 'matchDelete'])
        ->name('matches.delete');

    Route::get('/matches/{username}', [HomeController::class, 'matchDone'])
        ->name('matches.done');

    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index');

    Route::get('/events/create', [EventController::class, 'create'])
        ->name('events.create');

    Route::post('/events', [EventController::class, 'store'])
        ->name('events.store');

    Route::get('/events/{event}', [EventController::class, 'show'])
        ->name('events.show');

    Route::get('/search', [HomeController::class, 'search'])
        ->name('search.user');


    Route::post('/stories', [StoryController::class, 'store'])
        ->name('stories.store');

    Route::post('/stories/delete/{story}', [StoryController::class, 'destroy'])
        ->name('stories.delete');

});


// Auth routes

Route::get('/register', [RegisterController::class,'create'])
    ->name('register.form');

Route::get('/auth/google', [RegisterController::class, 'googleRedirect'])->name('google_page');

Route::get('/auth/google/callback', [RegisterController::class, 'googleCallback'])->name('google_redirect');

Route::get('/register/email', [RegisterController::class, 'email'])
    ->name('register.email');

Route::post('/register/email', [RegisterController::class, 'register'])
    ->name('register.email.store');

Route::get('/register/gender', [RegisterController::class, 'gender'])
    ->name('register.gender');

Route::post('/register/gender', [RegisterController::class, 'storeGender'])
    ->name('register.gender.store');

Route::get('/register/hobbies', [RegisterController::class, 'hobbies'])
    ->name('register.hobbies');

Route::post('/register/hobbies', [RegisterController::class, 'storeHobbies'])
    ->name('register.hobbies.store');

// Hobby routes

Route::get('/hobby', [HobbyController::class,'index'])
    ->name('hobby.index');



// Admin routes

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/control', [AdminController::class, 'index'])->name('admin.index');

    Route::prefix('/control')->group(function(){

        // Users

        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::delete('/users/{user}/delete', [AdminController::class, 'softDeleteUser'])->name('admin.users.delete');
        Route::post('/users/{user}/restore', [AdminController::class, 'restoreUser'])->name('admin.users.restore');
        Route::get('/roles', [AdminController::class, 'roles'])->name('admin.roles');
        Route::post('/roles', [RoleController::class, 'addRole'])->name('admin.roles.add');
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


Route::get('/contacts', [HomeController::class, 'contacts'])
    ->name('contacts');


Route::get('/sendmail', [MailController::class, 'send'])
    ->name('sendmail');
