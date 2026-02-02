<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('login');
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

Route::get('/dashboard', [DashboardController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
