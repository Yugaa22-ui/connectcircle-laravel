<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('landing');
});

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Guest
Route::get('/guest', [GuestController::class, 'index'])
    ->name('guest')
    ->middleware('guest');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
