<?php

use function Livewire\Volt\{state, mount};

state(['postId']);

mount(function ($postId) {
    $this->postId = $postId;
});

$comment = function () {};

?>

<div class="flex-1">
    <div class="flex gap-3">
        <input type="text" placeholder="Write a comment..."
            class="flex-1 px-4 py-2 bg-gray-100 rounded-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition">
    </div>
</div>
