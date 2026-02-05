<?php

use function Livewire\Volt\{state, mount};
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

state(['userId', 'friendId', 'accepted' => false, 'canceled' => false]);

mount(function ($friendId) {
    $this->userId = Auth::id();
    $this->friendId = $friendId;
});

$acceptRequest = function () {
    $request = Friendship::where(function ($query) {
        $query->where('user_id', $this->userId)->where('friend_id', $this->friendId);
    })
        ->orWhere(function ($query) {
            $query->where('user_id', $this->friendId)->where('friend_id', $this->userId);
        })
        ->first();

    if ($request) {
        $request->status = 'accepted';
        $request->save();

        $this->accepted = true;
        session()->flash('message', 'Request accepted');
    } else {
        session()->flash('error', 'Request not found');
    }
};

$rejectRequest = function () {
    Friendship::where(function ($query) {
        $query->where('user_id', $this->userId)->where('friend_id', $this->friendId);
    })
        ->orWhere(function ($query) {
            $query->where('user_id', $this->friendId)->where('friend_id', $this->userId);
        })
        ->delete();

    $this->canceled = true;

    session()->flash('message', 'Request Canceled');
};

?>

<div class="flex gap-2 w-full">
    @if ($accepted)
        <button disabled class="w-full bg-gray-100 text-green-600 py-2 rounded-lg font-medium cursor-not-allowed">
            ✓ Friends
        </button>
    @elseif ($canceled)
        <button disabled class="w-full bg-gray-100 text-gray-500 py-2 rounded-lg font-medium cursor-not-allowed">
            Removed
        </button>
    @else
        <button wire:click="acceptRequest"
            class="flex-1 bg-gradient-to-r from-green-400 to-blue-500 text-white py-2 px-6 rounded-lg font-medium hover:shadow-lg transition">
            Accept
        </button>

        <button wire:click="rejectRequest"
            class="bg-gray-200 text-gray-700 py-2 px-4 rounded-lg text-sm font-medium hover:bg-gray-300 transition">
            Remove
        </button>
    @endif
</div>
