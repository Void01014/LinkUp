<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Profile Header -->
            <div class="bg-white/80 backdrop-blur-md border border-gray-100 shadow-xl rounded-3xl mb-8 overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-center gap-10">

                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-tr from-green-400 to-blue-500 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000">
                            </div>
                            <div
                                class="relative w-36 h-36 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-extrabold text-5xl shadow-inner border-4 border-white">
                                {{ strtoupper(substr($ex_user->first_name, 0, 1)) }}
                            </div>
                        </div>

                        <div class="flex-1 text-center md:text-left">
                            <div class="mb-6">
                                <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-2">
                                    {{ $ex_user->first_name }} {{ $ex_user->last_name }}
                                </h1>
                                @if ($ex_user->bio)
                                    <p class="text-gray-500 leading-relaxed max-w-xl italic">
                                        "{{ $ex_user->bio }}"
                                    </p>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-8 justify-center md:justify-start mb-8">
                                <div class="flex flex-col">
                                    <span
                                        class="text-2xl font-bold text-gray-900">{{ number_format($ex_user->friends_count ?? 0) }}</span>
                                    <span
                                        class="text-xs uppercase tracking-widest text-gray-400 font-semibold">Friends</span>
                                </div>
                                <div class="w-px h-10 bg-gray-100 hidden sm:block"></div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-2xl font-bold text-gray-900">{{ number_format($postsCount ?? 0) }}</span>
                                    <span
                                        class="text-xs uppercase tracking-widest text-gray-400 font-semibold">Posts</span>
                                </div>
                                <div class="w-px h-10 bg-gray-100 hidden sm:block"></div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-2xl font-bold text-gray-900">{{ $ex_user->created_at->format('M Y') }}</span>
                                    <span class="text-xs uppercase tracking-widest text-gray-400 font-semibold">Member
                                        Since</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                @if ($ex_user->status == null)
                                    <livewire:addfriendbutton :friend-id="$ex_user->id" :key="'btn-' . $user->id" />
                                        @elseif ($ex_user->status == 'pending')
                                        <button
                                        class="flex items-center justify-center gap-2 w-full bg-gray-100 text-gray-500 px-6 py-3 rounded-xl font-semibold transition-all duration-200 cursor-not-allowed"
                                        disabled>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Request Pending
                                    </button>
                                    <livewire:acceptrequestbutton :friend-id="$ex_user->id" :key="'btn-' . $user->id" />
                                @elseif ($ex_user->status == 'accepted')
                                    <livewire:removefriendbutton :friend-id="$ex_user->id" :key="'btn-' . $user->id" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">
                        Posts
                    </h2>

                    @forelse($ex_user->posts as $post)
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
                                            <button
                                                class="moreBtn text-gray-400 hover:text-gray-600 focus:outline-none">
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
                                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                    alt="Post Image" class="w-full h-auto max-h-[500px] object-cover">
                                                <div class="absolute inset-0 bg-black opacity-0 pointer-events-none">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <!-- Post Stats -->
                                <div
                                    class="flex items-center justify-between py-2 border-t border-b border-gray-200 mb-3">
                                    <span class="text-sm text-gray-600">
                                        <span class="font-semibold">{{ $post->likes_count }}</span> likes
                                    </span>
                                    <span class="text-sm text-gray-600">
                                        <span class="font-semibold">{{ $post->comments_count }}</span> comments
                                    </span>
                                </div>

                                <!-- Like and Comment section -->
                                <div class="flex gap-2 mb-4">
                                    <livewire:posts.likepost :post-id="$post->id" :i-liked="$post->i_liked" :key="'like-' . $post->id" />

                                    <livewire:posts.comment-input :post-id="$post->id" :key="'comment-' . $post->id" />

                                </div>
                                <livewire:posts.comment-list :post="$post" :post-id="$post->id" :key="'commentList-' . $post->id" />
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@php
    // FAKE DATA - Replace with real data from controller

    $profileUser = (object) [
        'id' => 2,
        'first_name' => 'Salah',
        'last_name' => 'El Masry',
        'bio' =>
            'Software developer passionate about Laravel and web development. Love to code and share knowledge with the community!',
        'friends_count' => 245,
        'created_at' => now()->subMonths(8),
    ];

    $postsCount = 23;

@endphp
