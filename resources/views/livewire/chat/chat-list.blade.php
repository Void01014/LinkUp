<?php

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use function Livewire\Volt\{state, on};

state(['receiverId', 'messages' => []]);

on([
    'echo:chat-' . Auth::id() . ',MessageSent' => function ($event) {
        logger('PUBLIC HIT!', $event);

        $messageModel = \App\Models\Message::make($event['message']);
        $this->messages[] = $messageModel;
    },
    // From your Input Component (Yourself)
    'message-sent' => function ($message) {
        $messageModel = $message instanceof Message ? $message : Message::make($message);

        if (!$messageModel->created_at) {
            $messageModel->created_at = now();
        }

        $this->messages[] = $messageModel;

        logger('message from me:' . $message['content']);
    },
]);

?>

<div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
    @foreach ($messages as $message)
        @php
            $isMe = $message->sender_id == Auth::id();
        @endphp

        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
            <div class="max-w-xs lg:max-w-md">
                <div
                    class="px-4 py-2.5 shadow-lg rounded-2xl {{ $isMe
                        ? 'bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-tr-sm'
                        : 'bg-white text-gray-800 border border-gray-100 rounded-tl-sm' }}">

                    <p class="text-sm">{{ $message->content }}</p>
                </div>

                <div class="flex items-center gap-1 mt-1 px-2 {{ $isMe ? 'justify-end' : 'justify-start' }}">
                    <span class="text-xs text-gray-500">
                        {{ $message->created_at?->format('g:i A') }}
                    </span>

                    @if ($isMe)
                        <svg class="w-4 h-4 {{ $message->is_read ? 'text-blue-500' : 'text-gray-400' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                            </path>
                        </svg>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
