<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\{state};

state(['postId', 'content' => '']);

$postComment = function () {
    if (empty(trim($this->content))) {
        return;
    }

    $post = Post::find($this->postId);
    $post->comments()->create([
        'user_id' => Auth::id(),
        'content' => $this->content,
    ]);

    $this->content = '';
    $this->dispatch("comment-added-{$this->postId}");
};

?>

<div class="flex-1">
    <div class="flex gap-3">
        <input wire:model.defer="content" type="text" placeholder="Write a comment..."
            class="flex-1 px-4 py-2 bg-gray-100 rounded-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition">
        <button wire:click="postComment"
            class="group relative flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-green-300 to-blue-400 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-200 focus:outline-none">
            <svg class="w-5 h-5 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>

            <div class="absolute inset-0 rounded-full bg-white opacity-0 group-hover:opacity-20 transition-opacity">
            </div>
        </button>
    </div>
</div>
