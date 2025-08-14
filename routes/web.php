<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\ProfileController;
// use App\Http\Controllers\Circle\CircleController;
// use App\Http\Controllers\Friend\FriendController;

// =============================
// Public Routes
// =============================

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

// Guest Page
Route::get('/guest', [GuestController::class, 'index'])
    ->name('guest')
    ->middleware('guest');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.post');


// =============================
// Authenticated User Routes
// =============================
Route::middleware(['auth'])->group(function () {

    // Dashboard User
    Route::get('/dashboard/user', [DashboardUserController::class, 'index'])
        ->name('user.dashboard');

    // // Profile
        Route::middleware(['auth'])->group(function () {
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        });

    // // Circle
    // Route::get('/circle/create', [CircleController::class, 'create'])
    //     ->name('circle.create');
    // Route::get('/circle/join', [CircleController::class, 'join'])
    //     ->name('circle.join');
    // Route::get('/circle/view', [CircleController::class, 'view'])
    //     ->name('circle.view');

    // // Friends
    // Route::get('/friend/search', [FriendController::class, 'search'])
    //     ->name('friend.search');
    // Route::get('/friend/requests', [FriendController::class, 'requests'])
    //     ->name('friend.requests');
    // Route::get('/friend/list', [FriendController::class, 'list'])
    //     ->name('friend.list');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
