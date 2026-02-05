<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Feed;
use App\Http\Controllers\Friendship as ControllersFriendship;
use App\Http\Controllers\User;

Route::get('/', function () {
    return redirect('login');
});

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'create'])->name('dashboard');
    Route::get('/search', [User::class, 'search'])->name('search');
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/feed', [Feed::class, 'view'])->name('feed.view');
    Route::post('/', [Feed::class, 'store'])->name('posts.store');
    Route::get('/friends', [ControllersFriendship::class, 'view'])->name('feed.view');
});
require __DIR__.'/auth.php';
