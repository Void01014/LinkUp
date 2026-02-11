<?php

use function Livewire\Volt\{state, mount, on};

state(['userId', 'messages']);

mount(function ($userId, $messages) {
    $this->userId = $userId;
    $this->messages = $messages;
});

// on('echo-private:chat'.{$userId}.);

$refresh = function () {};

?>

<div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
    @foreach ($messages as $message)
        @if ($message->sender_id == Auth::id())
            <!-- Sent Message (Right) -->
            <div class="flex justify-end">
                <div class="max-w-xs lg:max-w-md">
                    <div
                        class="bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-2xl shadow-lg rounded-tr-sm px-4 py-2.5">
                        <p class="text-sm p">{{ $message->content }}</p>
                    </div>
                    <div class="flex items-center justify-end gap-1 mt-1 px-2">
                        <span class="text-xs text-gray-500">{{ $message->created_at->format('g:i A') }}</span>
                        @if ($message->is_read)
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                                </path>
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                                </path>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Received Message (Left) -->
            <div class="flex justify-start">
                <div class="max-w-xs lg:max-w-md">
                    <div
                        class="bg-white text-gray-800 rounded-2xl rounded-tl-sm px-4 py-2.5 shadow-lg border border-gray-100">
                        <p class="text-sm p">{{ $message->content }}</p>
                    </div>
                    <div class="flex items-center gap-1 mt-1 px-2">
                        <span class="text-xs text-gray-500">{{ $message->created_at->format('g:i A') }}</span>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
