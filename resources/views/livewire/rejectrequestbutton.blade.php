<?php

use function Livewire\Volt\{state, mount};
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

state(['userId', 'friendId', 'rejected' => false]);

mount(function ($friendId) {
    $this->userId = Auth::id();
    $this->friendId = $friendId;
});

$rejectRequest = function () {
    Friendship::where(function ($query) {
        $query->where('user_id', $this->userId)->where('friend_id', $this->friendId);
    })
        ->orWhere(function ($query) {
            $query->where('user_id', $this->friendId)->where('friend_id', $this->userId);
        })
        ->delete();

    $this->rejected = true;

    session()->flash('message', 'You are no loner friends');
};
?>

<div>
    <div class="flex gap-2">
        <button wire:click="rejectRequest" onclick="event.preventDefault(); event.stopPropagation();"
            class="flex-1 bg-red-500 text-white py-2 px-2 rounded-lg font-medium hover:bg-red-600 transition">
            Unfriend
        </button>
    </div>

    @if (session()->has('message'))
        <span class="text-green-500 text-sm">{{ session('message') }}</span>
    @endif
</div>
