<?php

use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state, mount};

state(['friendId', 'sent' => false]);


$sendRequest = function () {
    Friendship::create([
        'user_id' => Auth::id(),
        'friend_id' => $this->friendId,
        'status' => 'pending',
    ]);

    $this->sent = true;

    session()->flash('message', 'Request Sent!');
};
?>

<div>
    @if($sent || session()->has('message'))
        <button 
                disabled class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium cursor-not-allowed">
            Request Pending...
        </button>
    @else
        <button onclick="event.stopPropagation();"
                wire:click="sendRequest"
            class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white py-2 rounded-lg font-medium hover:shadow-lg transition">
            Add Friend
        </button>
    @endif
</div>