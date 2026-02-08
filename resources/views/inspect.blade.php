<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Profile Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                        <!-- Avatar -->
                        <div
                            class="w-32 h-32 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-bold text-5xl flex-shrink-0">
                            {{ strtoupper(substr($ex_user->first_name, 0, 1)) }}
                        </div>

                        <!-- User Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                {{ $ex_user->first_name }} {{ $ex_user->last_name }}
                            </h1>

                            @if ($ex_user->bio)
                                <p class="text-gray-600 mb-4 max-w-2xl">
                                    {{ $ex_user->bio }}
                                </p>
                            @endif

                            <!-- Stats -->
                            <div class="flex gap-6 justify-center md:justify-start mb-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $ex_user->friends_count ?? 0 }}</p>
                                    <p class="text-sm text-gray-500">Friends</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $postsCount ?? 0 }}</p>
                                    <p class="text-sm text-gray-500">Posts</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $ex_user->created_at->format('M Y') }}</p>
                                    <p class="text-sm text-gray-500">Joined</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            @if ($user->status == null)
                                <livewire:addfriendbutton :user-id="$user->id" :key="'btn-' . $user->id" />
                            @elseif ($user->status == 'pending')
                                <button
                                    class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium cursor-not-allowed"
                                    disabled>
                                    Request Pending
                                </button>
                            @elseif ($user->status == 'accepted')
                                <livewire:removefriendbutton :friend-id="$user->id" :key="'btn-' . $user->id" />
                            @endif

                            <a href="/profile/edit"
                                class="inline-block bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium hover:bg-gray-300 transition">
                                Edit Profile
                            </a>
                            @endif
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

                    @forelse($posts as $post)
                        <div class="border-2 border-gray-200 rounded-lg p-6 mb-4 hover:border-gray-300 transition">
                            <!-- Post Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                        {{ strtoupper(substr($ex_user->first_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">
                                            {{ $ex_user->first_name }} {{ $ex_user->last_name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Post Content -->
                            <p class="text-gray-800 mb-4 leading-relaxed">{{ $post->content }}</p>

                            <!-- Post Image (if exists) -->
                            @if (!empty($post->featured_image))
                                <div class="mb-4 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Post image"
                                        class="w-full h-auto max-h-[500px] object-cover">
                                </div>
                            @endif

                            <!-- Post Stats -->
                            <div class="flex items-center justify-between py-2 border-t border-b border-gray-200 mb-3">
                                <span class="text-sm text-gray-600">
                                    <span class="font-semibold">{{ $post->likes_count ?? 0 }}</span> likes
                                </span>
                                <span class="text-sm text-gray-600">
                                    <span class="font-semibold">{{ $post->comments_count ?? 0 }}</span> comments
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
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
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="text-gray-500 font-medium">No posts yet</p>
                            @if (Auth::id() == $ex_user->id)
                                <p class="text-sm text-gray-400 mt-2">Share your first post!</p>
                            @endif
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    {{-- @if ($posts->hasPages())
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div> --}}
                    {{-- @endif --}}
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
