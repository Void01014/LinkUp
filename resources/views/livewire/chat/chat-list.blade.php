<?php

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use function Livewire\Volt\{state, on, mount};

state(['messages' => null, 'conversationId']);

mount(function ($conversationId) {
    $this->conversationId = $conversationId;
});

on(fn() => [
    "echo-private:chat.{$this->conversationId},.message.sent" => 'handleBroadcast',
    'message-sent' => 'handleOwnMessage',
]);

$handleBroadcast = function ($event) {
    if ($event['message']['user_id'] !== Auth::id()) {

        $messageModel = Message::make($event['message']);

        $messageModel->id = $event['message']['id'];
        $messageModel->created_at = $event['message']['created_at'];

        $this->messages[] = $messageModel;
        logger('message NOT from me:' . $messageModel->content);
    }
};

$handleOwnMessage = function ($message) {
    $messageModel = $message instanceof Message ? $message : Message::make($message);

    $messageModel->id = $message['id'];

    if (!$messageModel->created_at) {
        $messageModel->created_at = now();
    }

    // dd($messageModel);
    $this->messages[] = $messageModel;

    logger('message from me:' . $message['content']);
};

?>

<div id="messagesContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
    @foreach ($messages as $index => $message)
    @php
    $isMe = $message->user_id == Auth::id();
    // Create a unique key using message ID if available, otherwise use a combination of timestamp and index
    $uniqueKey = $message->id ?? ($message->created_at?->timestamp ?? time()) . '-' . $index;
    @endphp

    <div wire:key="msg-{{ $uniqueKey }}" class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
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