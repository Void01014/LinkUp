<?php
use function Livewire\Volt\{state, computed};
use App\Models\User;
use Illuminate\Support\Facades\Auth;

state(['search' => '']);

$users = computed(function () {
    $searchTerm = $this->search;

    if (empty($searchTerm)) {
        return [];
    }
    $words = explode(' ', $searchTerm);

    return User::withFriendsCount($words, Auth::id())->paginate(10);
});

?>

<div>
    <div class="flex flex-col justify-center bg-white shadow-sm sm:rounded-lg pt-20 mx-10 md:mx-80">
        <div class="py-6">
            <div class="flex gap-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users by name..."
                    class="flex-1 px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition">
                <button id="searchBtn"
                    class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition">
                    Search
                </button>
            </div>
        </div>
    </div>

    <div wire:loading wire:target="search" class="text-gray-500 text-center font-bold mb-4">
        Searching for users...
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Users Grid -->
            <div id="users_grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($this->users as $user)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- User Avatar & Name -->
                            <div class="flex flex-col items-center text-center mb-4">
                                <div
                                    class="w-24 h-24 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-bold text-2xl mb-3">
                                    {{ ucfirst($user->first_name[0]) }}
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $user->first_name }}
                                    {{ $user->last_name }}
                                </h3>
                            </div>

                            <!-- User Bio -->
                            <p class="text-sm text-gray-600 text-center mb-4 line-clamp-2">
                                {{ $user->bio }}
                            </p>

                            <!-- User Stats -->
                            <div class="flex justify-around border-t border-b border-gray-200 py-3 mb-4">
                                <div class="text-center">
                                    <p class="text-lg font-semibold text-gray-900">{{ $user->friends_count }}</p>
                                    <p class="text-xs text-gray-500">Friends</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ date_format($user->created_at, 'M Y') }}</p>
                                    <p class="text-xs text-gray-500">Member since</p>
                                </div>
                            </div>
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
