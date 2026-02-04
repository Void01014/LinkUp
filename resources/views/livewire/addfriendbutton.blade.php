<?php
use function Livewire\Volt\{state, mount};

state(['userId']);

mount(function ($userId) {
    $this->userId = $userId;
});
?>

<button wire:click="sendRequest">
    Add Friend (Target: {{ $userId }})
</button>