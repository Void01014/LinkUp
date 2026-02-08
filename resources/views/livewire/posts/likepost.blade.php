<?php

use App\Models\Post;
use function Livewire\Volt\{state, mount};

state(['postId', 'iLiked']);

mount(function ($postId, $iLiked) {
    $this->postId = $postId;

    $this->iLiked = $iLiked;
});

$toggle = function () {
    $this->iLiked = !$this->iLiked;

    auth()->user()->likedposts()->toggle($this->postId);
};

?>

<div class="flex-3">
    <button wire:click="toggle"
        class="w-full py-2 px-4 rounded-lg hover:bg-gray-100 transition flex items-center justify-center gap-2 font-medium {{ $iLiked ? 'text-blue-600' : 'text-gray-700' }}">
        
        <svg class="w-5 h-5 transition-colors duration-200" 
             fill="{{ $iLiked ? 'rgb(85, 194, 171)' : 'none' }}" 
             stroke="rgb(85, 194, 171)" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
            </path>
        </svg>
        
        <span>{{ $iLiked ? 'Liked' : 'Like' }}</span>
    </button>
</div>