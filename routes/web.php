<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('login');
});

// Route::get('login', function () {
//     return view('login');
// })->name('login');

// Route::post('/login', [AuthController::class, 'login'])->name('login');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
