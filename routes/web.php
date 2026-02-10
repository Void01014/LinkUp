<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Feed;
use App\Http\Controllers\Friendship as ControllersFriendship;
use App\Http\Controllers\InspectController;
use App\Http\Controllers\User;
use App\Http\Controllers\QrScanController;


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

Route::middleware('auth')->group(function () {
    Route::get('/search', [DashboardController::class, 'create'])->name('search.view');
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/feed', [Feed::class, 'view'])->name('feed.view');
    Route::get('/post_edit/{post_id}', [Feed::class, 'edit'])->name('post_edit');
    Route::post('/post_store', [Feed::class, 'store'])->name('posts.store');
    Route::put('/post_update/{post_id}', [Feed::class, 'update'])->name('post.update');
    Route::get('/friends', [ControllersFriendship::class, 'view'])->name('friends.view');
    Route::get('/inspect/{ex_userId}', [InspectController::class, 'view'])->name('inspect.view');
    Route::get('/chat/inbox', [ChatController::class, 'inbox'])->name('chat.inbox');
});

Route::middleware('auth')->group(function () {

    Route::get('/qr/generate', [QrScanController::class, 'generate'])

        ->name('qr.generate');

    Route::post('/qr/generate-link', [QrScanController::class, 'generateLink'])

        ->name('qr.generate-link');

});

Route::get('/friend/{token}', [QrScanController::class, 'scan'])

    ->name('qr.scan');


require __DIR__ . '/auth.php';
