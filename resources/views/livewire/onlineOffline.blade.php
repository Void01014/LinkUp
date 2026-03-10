<?php
use function Livewire\Volt\{state, on};

state(['avatar', 'userId', 'isOnline' => false]);

on([
    'user-online' => function ($userId) {
        if ($userId === $this->userId) {
            $this->isOnline = true;
        }
    },
    'user-offline' => function ($userId) {
        if ($userId === $this->userId) {
            $this->isOnline = false;
        }
    },
]);
?>

<div class="relative flex-shrink-0">
    <div
        class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold">
        {{ $avatar }}
    </div>
    @if (!$isOnline)
        <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-gray-500 border-2 border-white rounded-full">
        </div>
    @else
        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-600 border-2 border-white rounded-full">
        </div>
    @endif
</div>
