@php
    // FAKE DATA - Replace with real data from controller

    $conversations = [
        (object) [
            'id' => 1,
            'user' => (object) [
                'first_name' => 'Salah',
                'last_name' => 'El Masry',
                'is_online' => true,
            ],
            'last_message' => 'Hey! Did you see the new Laravel update?',
            'last_message_is_mine' => false,
            'unread_count' => 2,
        ],
        (object) [
            'id' => 2,
            'user' => (object) [
                'first_name' => 'Ahmed',
                'last_name' => 'Hassan',
                'is_online' => true,
            ],
            'last_message' => 'Thanks for your help!',
            'last_message_is_mine' => true,
            'unread_count' => 0,
        ],
        (object) [
            'id' => 3,
            'user' => (object) [
                'first_name' => 'Fatima',
                'last_name' => 'Mohamed',
                'is_online' => false,
            ],
            'last_message' => 'See you tomorrow!',
            'last_message_is_mine' => false,
            'unread_count' => 0,
        ],
    ];

    $activeConversation = (object) [
        'id' => 1,
        'user' => (object) [
            'first_name' => 'Salah',
            'last_name' => 'El Masry',
            'is_online' => true,
        ],
    ];

    $messages = [
        (object) [
            'id' => 1,
            'sender_id' => 2,
            'content' => 'Hey! How are you?',
            'created_at' => now()->subMinutes(30),
            'is_read' => true,
        ],
        (object) [
            'id' => 2,
            'sender_id' => Auth::id(),
            'content' => 'I\'m good! How about you?',
            'created_at' => now()->subMinutes(28),
            'is_read' => true,
        ],
        (object) [
            'id' => 3,
            'sender_id' => 2,
            'content' => 'Doing great! Did you see the new Laravel update?',
            'created_at' => now()->subMinutes(25),
            'is_read' => true,
        ],
        (object) [
            'id' => 4,
            'sender_id' => Auth::id(),
            'content' => 'Not yet! What\'s new in it?',
            'created_at' => now()->subMinutes(20),
            'is_read' => true,
        ],
        (object) [
            'id' => 5,
            'sender_id' => 2,
            'content' => 'They added some amazing features for real-time applications. You should check it out!',
            'created_at' => now()->subMinutes(2),
            'is_read' => false,
        ],
    ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="height: calc(100vh - 180px);">
                <div class="flex h-full">

                    <!-- Sidebar - Conversations List -->
                    <div class="w-full md:w-96 border-r border-gray-200 flex flex-col">
                        <!-- Sidebar Header -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Chats</h3>
                            </div>
                        </div>

                        <!-- Conversations List -->
                        <div class="flex-1 overflow-y-auto">
                            @forelse($conversations as $conversation)
                                <div class="conversation-item p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition {{ $activeConversation && $activeConversation->id == $conversation->id ? 'bg-blue-50' : '' }}"
                                    onclick="window.location.href='/chat/{{ $conversation->id }}'">
                                    <div class="flex gap-3">
                                        <!-- Avatar with Online Status -->
                                        <div class="relative flex-shrink-0">
                                            <div
                                                class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($conversation->user->first_name, 0, 1)) }}
                                            </div>
                                            @if ($conversation->user->is_online)
                                                <div
                                                    class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-gray-500 border-2 border-white rounded-full">
                                                </div>
                                            @else
                                                <div
                                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-600 border-2 border-white rounded-full">
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Conversation Info -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="font-semibold text-gray-900 truncate">
                                                    {{ $conversation->user->first_name }}
                                                    {{ $conversation->user->last_name }}
                                                </h4>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm text-gray-600 truncate">
                                                    @if ($conversation->last_message_is_mine)
                                                        <span class="text-gray-500">You: </span>
                                                    @endif
                                                    {{ $conversation->last_message }}
                                                </p>
                                                @if ($conversation->unread_count > 0)
                                                    <span
                                                        class="ml-2 px-2 py-0.5 bg-gradient-to-r from-green-400 to-blue-500 text-white text-xs font-bold rounded-full">
                                                        {{ $conversation->unread_count }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center h-full py-12">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 font-medium">No conversations yet</p>
                                    <p class="text-sm text-gray-400 mt-1">Start chatting with your friends!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Main Chat Window -->
                    <div class="flex-1 flex flex-col">
                        @if ($activeConversation)
                            <!-- Chat Header -->
                            <div class="p-4 border-b border-gray-200 flex items-center justify-between bg-white">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($activeConversation->user->first_name, 0, 1)) }}
                                        </div>
                                        @if ($activeConversation->user->is_online)
                                            <div
                                                class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full">
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">
                                            {{ $activeConversation->user->first_name }}
                                            {{ $activeConversation->user->last_name }}
                                        </h3>
                                        <p class="text-xs text-gray-500">
                                            {{ $activeConversation->user->is_online ? 'Active now' : 'Offline' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages Area -->
                            @livewire('chat.chat-list', ['receiver-id' => $receiver->id, 'messages' => $messages], key($user->id))

                            <!-- Message Input (Fixed Bottom) -->
                            <div class="p-4 border-t border-gray-200 bg-white">
                                <form action="/chat/{{ $activeConversation->id }}/send" method="POST"
                                    class="flex gap-3">
                                    @csrf
                                    <button type="button"
                                        class="p-3 hover:bg-gray-100 rounded-lg transition flex-shrink-0">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                    <input type="text" name="message" placeholder="Type a message..."
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
                        @else
                            <!-- Empty State - No Chat Selected -->
                            <div class="flex-1 flex items-center justify-center bg-gray-50">
                                <div class="text-center">
                                    <div
                                        class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-100 to-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Select a conversation</h3>
                                    <p class="text-gray-500">Choose a conversation from the sidebar to start messaging
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Scroll to bottom on load
        window.addEventListener('load', function() {
            const container = document.getElementById('messagesContainer');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        });

        // Auto-scroll to bottom when new message is added
        function scrollToBottom() {
            const container = document.getElementById('messagesContainer');
            if (container) {
                container.scrollTo({
                    top: container.scrollHeight,
                    behavior: 'smooth'
                });
            }
        }

        // Call scrollToBottom after form submission (you can integrate with AJAX)
        document.querySelector('form')?.addEventListener('submit', function(e) {
            setTimeout(scrollToBottom, 100);
        });
    </script>
</x-app-layout>
