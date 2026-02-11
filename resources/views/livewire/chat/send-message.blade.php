<?php

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\{state, mount, on};

state(['receiverId', 'message']);

$send = function () {
    if (empty(trim($this->message))) {
        return;
    }

    $newMessage = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $this->receiverId,
        'content' => $this->message,
    ]);

    MessageSent::dispatch($newMessage);

    $this->dispatch('message-sent', message: $newMessage);

    $this->message = '';
};
?>

<div class="p-4 border-t border-gray-200 bg-white">
    <form wire:submit="send" class="flex gap-3">
        @csrf
        <button type="button" class="p-3 hover:bg-gray-100 rounded-lg transition flex-shrink-0">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </button>
        <input type="text" wire:model="message" placeholder="Type a message..."
            class="flex-1 px-4 py-3 bg-gray-100 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            required>
        <button type="submit"
            class="p-3 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-full hover:shadow-lg transition flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
        </button>
    </form>
</div>
