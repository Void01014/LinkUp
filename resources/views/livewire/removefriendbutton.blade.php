<?php
use function Livewire\Volt\{state, mount};

state(['userId']);

mount(function ($userId) {
    $this->userId = $userId;
});

$sendRequest;
?>

<button
    class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition">
    Add Friend
</button>

<?php

use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state, mount};

state(['userId', 'sent' => false]);

mount(function ($userId) {
    $this->userId = $userId;
});

$sendRequest = function () {
    Friendship::create([
        'user_id' => Auth::id(),
        'friend_id' => $this->userId,
        'status' => 'pending',
    ]);

    $this->sent = true;

    session()->flash('message', 'Request Sent!');
};
?>

<div>
    <div class="flex gap-2">
        <button class="flex-1 bg-red-500 text-white py-2 rounded-lg font-medium hover:bg-red-600 transition">
            Unfriend
        </button>
    </div>

    @if (session()->has('message'))
        <span class="text-green-500 text-sm">{{ session('message') }}</span>
    @endif
</div>
