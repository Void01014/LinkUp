@php
    // FAKE DATA - Replace with real data from controller
    $post =
        $post ??
        (object) [
            'id' => 1,
            'content' =>
                'Just finished an amazing project! Laravel makes everything so much easier. Can\'t wait to share what I\'ve built with you all! 🚀',
            'featured_image' => null, // or 'posts/image.jpg'
            'user' => (object) [
                'id' => 1,
                'first_name' => 'Ahmed',
                'last_name' => 'Hassan',
            ],
        ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Post Author Info -->
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                            {{ strtoupper(substr($post->user->first_name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">
                                {{ $post->user->first_name ?? 'User' }} {{ $post->user->last_name ?? '' }}
                            </h3>
                            <p class="text-sm text-gray-500">Editing post</p>
                        </div>
                    </div>

                    <!-- Edit Form -->
                    <form action="{{ route('post.update', ['post_id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Post Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                What's on your mind?
                            </label>
                            <textarea id="content" name="content" rows="6"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition resize-none"
                                placeholder="Share your thoughts..." required>{{ old('content', $post->content) }}</textarea>

                            @error('content')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Current Image Preview -->
                        @if (!empty($post->featured_image))
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Current Image
                                </label>
                                <div class="relative rounded-lg overflow-hidden border-2 border-gray-200 group">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current post image"
                                        class="w-full h-auto max-h-[400px] object-cover">
                                    <!-- Remove Image Overlay -->
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition flex items-center justify-center">
                                        <label class="cursor-pointer opacity-0 group-hover:opacity-100 transition">
                                            <input type="checkbox" name="remove_image" value="1" class="hidden"
                                                onchange="this.parentElement.parentElement.parentElement.style.opacity='0.5'">
                                            <span
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-600 transition">
                                                Remove Image
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    Hover over the image and click "Remove Image" to delete it, or upload a new one
                                    below to replace it.
                                </p>
                            </div>
                        @endif

                        <!-- Upload New Image -->
                        <div class="mb-6">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ empty($post->featured_image) ? 'Add Image' : 'Replace Image' }}
                            </label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition">
                                <input type="file" id="featured_image" name="featured_image" accept="image/*"
                                    class="hidden" onchange="previewImage(event)">
                                <label for="featured_image" class="cursor-pointer">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-sm text-gray-600 mb-1">Click to upload an image</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </label>
                            </div>

                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <img id="preview"
                                    class="w-full h-auto max-h-[400px] object-cover rounded-lg border-2 border-gray-200"
                                    alt="Preview">
                            </div>

                            @error('featured_image')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 rounded-lg font-medium hover:shadow-lg transition">
                                Save Changes
                            </button>
                            <a href="/feed"
                                class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-medium text-center hover:bg-gray-300 transition">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Post Preview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview</h3>

                    <!-- Preview Post Card -->
                    <div class="border-2 border-gray-200 rounded-lg p-4">
                        <!-- Post Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex gap-3">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($post->user->first_name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        {{ $post->user->first_name ?? 'User' }} {{ $post->user->last_name ?? '' }}
                                    </h3>
                                    <p class="text-sm text-gray-500">Just now</p>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Content -->
                        <p id="contentPreview" class="text-gray-800 mb-4 leading-relaxed">
                            {{ $post->content }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Image preview
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

        // Live preview of content
        const contentTextarea = document.getElementById('content');
        const contentPreview = document.getElementById('contentPreview');

        contentTextarea.addEventListener('input', function() {
            contentPreview.textContent = this.value || 'Your post content will appear here...';
        });
    </script>
</x-app-layout>
