<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/guest', function () {
    return view('guest');
})->middleware('guest');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
