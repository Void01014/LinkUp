<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('password_request', function () {
    return view('password_request');
})->name('password.request');

Route::get('register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('profile', function () {
    return view('profile');
})->name('profile');

Route::get('reset_password', function () {
    return view('reset_password');
})->name('reset_password');

Route::get('update_password', function () {
    return view('update_password');
})->name('update_password');

// Route::post('/forgot-password', [Password]);