<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('password_request', function () {
    return view('password_request');
})->name('password.request');

Route::get('register', function () {
    return view('register');
})->name('register');

Route::get('profile', function () {
    return view('profile');
})->name('profile');