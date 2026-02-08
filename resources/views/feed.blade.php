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
                                    class="w-full px-4 py-3 border-2 {{ $errors->has('content') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-500 transition resize-none"
                                    rows="3" required>{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                @enderror

                                <div class="flex justify-between items-center mt-3">
                                    <div class="flex gap-2 flex-col">
                                        <div class="flex gap-2">
                                            <input type="file" name="featured_image" id="featured_image"
                                                class="hidden" accept="image/*" onchange="previewImage(event)">
                                            <label for="featured_image"
                                                class="cursor-pointer px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                Photo
                                            </label>
                                        </div>

                                        @error('featured_image')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror

                                        <div id="imagePreview" class="mt-2 hidden">
                                            <div class="relative">
                                                <img id="preview"
                                                    class="w-full h-auto max-h-[400px] object-cover rounded-lg border-2 border-gray-200"
                                                    alt="Preview">
                                                <button type="button" onclick="removePreview()"
                                                    class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border">
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
                            <!-- Post actions -->
                            @if ($post->user_id == $user->id)
                                <div class="relative">
                                    <button class="moreBtn text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                            </path>
                                        </svg>
                                    </button>

                                    <div
                                        class="popup-class absolute right-0 mt-2 w-60 bg-white border border-gray-100 rounded-lg shadow-xl z-50 hidden">
                                        <div class="py-2">
                                            <a href="{{ route('post.edit') }}" id="{{ $post->id }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Edit Post
                                            </a>

                                            <livewire:posts.deletepost :post-id="$post->id" :key="'btn-' . $post->id" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Post Content -->
                        <p class="text-gray-800 mb-4 leading-relaxed">{{ $post['content'] }}</p>

                        <!-- Post Image (if exists) -->
                        @if (!empty($post->featured_image))
                            @if ($post->featured_image)
                                <div
                                    class="mb-4 rounded-xl overflow-hidden bg-gray-100 border border-gray-100 shadow-sm group">
                                    <div class="relative overflow-hidden">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Post Image"
                                            class="w-full h-auto max-h-[500px] object-cover">
                                        <div class="absolute inset-0 bg-black opacity-0 pointer-events-none">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Post Stats -->
                        <div class="flex items-center justify-between py-2 border-t border-b border-gray-200 mb-3">
                            <span class="text-sm text-gray-600">
                                <span class="font-semibold">{{ $post->likes_count }}</span> likes
                            </span>
                            <span class="text-sm text-gray-600">
                                <span class="font-semibold">{{ $post['comments_count'] }}</span> comments
                            </span>
                        </div>

                        <!-- Like and Comment section -->
                        <div class="flex gap-2 mb-4">
                            <livewire:posts.likepost :post-id="$post->id" :i-liked="$post->i_liked" :key="'like-'.$post->id" />

                            <livewire:posts.comment-input :post-id="$post->id" :key="'comment-'.$post->id"/>

                            </div>
                            <livewire:posts.comment-list :post="$post" :key="'commentList-'.$post->id"/>
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
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removePreview() {
            const previewContainer = document.getElementById('imagePreview');
            const fileInput = document.getElementById('featured_image');

            previewContainer.classList.add('hidden');
            fileInput.value = '';
        }
    </script>
</x-app-layout>
