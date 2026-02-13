<?php $friendsExist = false; ?>
<?php $requestsExist = false; ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Friends
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">

                <!-- Main Friends List -->
                <div class="flex-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    All Friends ({{ $friends_count }})
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($friends as $friend)
                                    @if ($friend->status == 'accepted')
                                        <?php $friendsExist = true; ?>
                                        <a href="{{ route('inspect.view', ['ex_userId' => $friend->id]) }}" class="block">
                                            <div
                                                class="flex items-center gap-4 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-md transition cursor-pointer">
                                                <!-- Avatar -->
                                                <div
                                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                                                    {{ strtoupper(substr($friend->first_name, 0, 1)) }}
                                                </div>

                                                <!-- Friend Info -->
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-semibold text-gray-900 truncate">
                                                        {{ $friend->first_name }} {{ $friend->last_name }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $friend->friends_count }} friends
                                                    </p>
                                                </div>

                                                <!-- Action Buttons -->
                                                <div class="flex gap-2">
                                                    <livewire:removefriendbutton :friend-id="$friend->id" :key="'btn-' . $friend->id" />
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                                @if (!$friendsExist)
                                    <div class="col-span-2 text-center py-12">
                                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 font-medium">No friends yet</p>
                                        <p class="text-sm text-gray-400 mt-2">Start connecting with people!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Friend Requests Sidebar -->
                <div class="lg:w-90">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Friend Requests
                            </h3>

                            <div class="space-y-3">
                                @foreach ($friends as $request)
                                    @if ($request->status == 'pending')
                                        <?php $requestsExist = true; ?>
                                        <div
                                            class="border-2 border-gray-200 rounded-lg p-3 hover:border-blue-300 transition">
                                            <a href="/profile/{{ $request->id }}" class="block mb-3">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-pink-500 flex items-center justify-center text-white font-bold flex-shrink-0">
                                                        {{ strtoupper(substr($request->first_name, 0, 1)) }}
                                                    </div>

                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="font-semibold text-sm text-gray-900 truncate">
                                                            {{ $request->first_name }} {{ $request->last_name }}
                                                        </h4>
                                                        <p class="text-xs text-gray-500">
                                                            {{ $request->friends_count }} friends
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <livewire:acceptrequestbutton :friend-id="$request->id" :key="'btn-' . $request->id" />
                                        </div>
                                    @endif
                                @endforeach
                            @if(!$requestsExist)
                                <div class="text-center py-8">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-500">No pending requests</p>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- Suggestions (Optional) -->
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@php
    // FAKE DATA - Replace with real data from controller
    // This is just for demonstration

    // Main friends list (status = 'accepted')
@endphp
