@php
    $posts = $posts ?? [
        [
            'author' => 'Sarah Williams',
            'time' => '2 hours ago',
            'content' =>
                'Just finished an amazing project! Laravel makes everything so much easier. Can\'t wait to share what I\'ve built with you all! 🚀',
            'image' => true,
            'likes' => 142,
            'comments_count' => 8,
            'comments' => [
                ['author' => 'John Doe', 'text' => 'Looks amazing! Can\'t wait to see it!', 'time' => '1 hour ago'],
                ['author' => 'Mike Johnson', 'text' => 'Great work Sarah! 👏', 'time' => '45 min ago'],
            ],
        ],
        [
            'author' => 'David Brown',
            'time' => '5 hours ago',
            'content' =>
                'Morning workout done! Remember, consistency is key. What did you do today to get closer to your goals? 💪',
            'image' => false,
            'likes' => 89,
            'comments_count' => 12,
            'comments' => [
                [
                    'author' => 'Emily Davis',
                    'text' => 'So motivating! Just did my morning run 🏃‍♀️',
                    'time' => '4 hours ago',
                ],
            ],
        ],
        [
            'author' => 'Emily Davis',
            'time' => '1 day ago',
            'content' =>
                'Currently reading "The Midnight Library" and I absolutely love it! Any book recommendations for my next read? 📚',
            'image' => true,
            'likes' => 256,
            'comments_count' => 24,
            'comments' => [
                ['author' => 'Jane Smith', 'text' => 'Try "Atomic Habits" - life changing!', 'time' => '1 day ago'],
                [
                    'author' => 'Alex Martinez',
                    'text' => 'Love that book! Read "The Alchemist" next',
                    'time' => '20 hours ago',
                ],
                ['author' => 'Lisa Anderson', 'text' => 'Great choice! 📖', 'time' => '18 hours ago'],
            ],
        ],
        [
            'author' => 'Alex Martinez',
            'time' => '2 days ago',
            'content' =>
                'New beat just dropped! Check out my latest track on SoundCloud. Let me know what you think! 🎵🎧',
            'image' => false,
            'likes' => 178,
            'comments_count' => 15,
            'comments' => [['author' => 'Chris Taylor', 'text' => 'Fire! 🔥', 'time' => '2 days ago']],
        ],
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Feed
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Create Post Box -->
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <textarea name="content" placeholder="What's on your mind?"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition resize-none"
                                    rows="3" required></textarea>

                                <div class="flex justify-between items-center mt-3">
                                    <div class="flex gap-2">
                                        <input type="file" name="featured_image" id="featured_image" class="hidden"
                                            accept="image/*">

                                        <label for="featured_image"
                                            class="cursor-pointer px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Photo
                                        </label>
                                    </div>
                                    <button type="submit"
                                        class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition">
                                        Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <!-- Feed Posts -->
            @foreach ($posts as $post)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6">
                        <!-- Post Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex gap-3">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($post->user->first_name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $post['author'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $post['time'] }}</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <!-- Post Content -->
                        <p class="text-gray-800 mb-4 leading-relaxed">{{ $post['content'] }}</p>

                        <!-- Post Image (if exists) -->
                        @if (!empty($post['image']))
                            <div class="mb-4 rounded-lg overflow-hidden">
                                <div
                                    class="bg-gradient-to-br from-green-100 to-blue-100 h-64 flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <!-- Post Stats -->
                        <div class="flex items-center justify-between py-2 border-t border-b border-gray-200 mb-3">
                            <span class="text-sm text-gray-600">
                                <span class="font-semibold">{{ $post['likes'] }}</span> likes
                            </span>
                            <span class="text-sm text-gray-600">
                                <span class="font-semibold">{{ $post['comments_count'] }}</span> comments
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 mb-4">
                            <button
                                class="flex-1 py-2 px-4 rounded-lg hover:bg-gray-100 transition flex items-center justify-center gap-2 text-gray-700 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                    </path>
                                </svg>
                                Like
                            </button>
                            <button
                                class="flex-1 py-2 px-4 rounded-lg hover:bg-gray-100 transition flex items-center justify-center gap-2 text-gray-700 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Comment
                            </button>
                        </div>

                        <!-- Comments Section -->
                        @if (!empty($post['comments']))
                            <div class="space-y-3">
                                @foreach ($post['comments'] as $comment)
                                    <div class="flex gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                                            {{ strtoupper(substr($comment['author'], 0, 2)) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-gray-100 rounded-2xl px-4 py-2">
                                                <p class="font-semibold text-sm text-gray-900">{{ $comment['author'] }}
                                                </p>
                                                <p class="text-sm text-gray-800">{{ $comment['text'] }}</p>
                                            </div>
                                            <div class="flex gap-4 px-4 mt-1">
                                                <button
                                                    class="text-xs text-gray-500 hover:text-blue-600 font-medium">Like</button>
                                                <button
                                                    class="text-xs text-gray-500 hover:text-blue-600 font-medium">Reply</button>
                                                <span class="text-xs text-gray-400">{{ $comment['time'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Add Comment -->
                        <div class="flex gap-3 mt-4">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}
                            </div>
                            <input type="text" placeholder="Write a comment..."
                                class="flex-1 px-4 py-2 bg-gray-100 rounded-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Load More -->
            <div class="text-center py-6">
                <button
                    class="bg-white px-8 py-3 rounded-lg shadow-sm font-medium text-gray-700 hover:shadow-md transition">
                    Load More Posts
                </button>
            </div>

        </div>
    </div>
</x-app-layout>
