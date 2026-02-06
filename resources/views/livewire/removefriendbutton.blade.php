<?php

use function Livewire\Volt\{state, mount};
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

state(['userId', 'friendId', 'removed' => false]);

mount(function ($friendId) {
    $this->userId = Auth::id();
    $this->friendId = $friendId;
});

$removeFriend = function () {
    Friendship::where(function ($query) {
        $query->where('user_id', $this->userId)->where('friend_id', $this->friendId);
    })
        ->orWhere(function ($query) {
            $query->where('user_id', $this->friendId)->where('friend_id', $this->userId);
        })
        ->delete();

    $this->removed = true;

    session()->flash('message', 'You are no longer friends');
};
?>

<div>
    <div class="flex flex-col gap-2">
        @if ($removed || session()->has('message'))
            <span class="text-green-500 text-sm font-medium">
                {{ session('message') ?? 'You Are no Longer Friends' }}
            </span>
        @else
            <button wire:click="removeFriend" onclick="event.preventDefault(); event.stopPropagation();"
                class="w-full bg-red-500 text-white py-2 px-2 rounded-lg font-medium hover:bg-red-600 transition">
                Unfriend
            </button>
        @endif
    </div>
</div>
