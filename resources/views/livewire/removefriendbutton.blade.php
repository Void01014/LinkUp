<?php
use function Livewire\Volt\{state, mount};
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

state(['userId', 'removed' => false]);

mount(function ($userId) {
    $this->userId = $userId;
});

$removeFriend = function () {
    Friendship::where()delete([
        'user_id' => Auth::id(),
        'friend_id' => $this->userId,
        'status' => 'pending',
    ]);

    $this->removed = true;

    session()->flash('message', 'removed from friends');
};
?>

<div>
    <div class="flex gap-2">
        <button class="flex-1 bg-red-500 text-white py-2 rounded-lg font-medium hover:bg-red-600 transition">
            Unfriend
        </button>
    </div>

    @if (session()->has('message'))
        <span class="text-green-500 text-sm">{{ session('message') }}</span>
    @endif
</div>
