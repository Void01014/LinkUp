<?php

use function Livewire\Volt\{state, mount};

state(['post']);

mount(function ($post) {
    $this->post = $post;
});

$comment = function () {};
?>

<div class="flex-1">
    @if (!empty($post->comments))
        <div class="space-y-3">
            @foreach ($post->comments as $comment)
                <div class="flex gap-3">
                    <div
                        class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-green-400 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                        {{ strtoupper(substr($comment['author'], 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-100 rounded-2xl px-4 py-2">
                            <p class="font-semibold text-sm text-gray-900">
                                {{ $comment['author'] }}
                            </p>
                            <p class="text-sm text-gray-800">{{ $comment->content }}</p>
                        </div>
                        <div class="flex gap-4 px-4 mt-1">
                            <span class="text-xs text-gray-400">{{ date_format($comment->created_at, 'd-m-Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
