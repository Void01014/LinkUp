@php
    //     $users = [
    //     [
    //         'name' => 'John Doe',
    //         'username' => '@johndoe',
    //         'bio' => 'Software developer passionate about Laravel and web development. Love to code and share knowledge!',
    //         'friends' => 245,
    //         'posts' => 89,
    //         'joined' => 'Jan 2024',
    //         'status' => 'stranger' // stranger, pending, friends
    //     ],
    //     [
    //         'name' => 'Jane Smith',
    //         'username' => '@janesmith',
    //         'bio' => 'Designer & artist. Creating beautiful things every day. Coffee lover ☕',
    //         'friends' => 512,
    //         'posts' => 156,
    //         'joined' => 'Mar 2024',
    //         'status' => 'pending'
    //     ],
    //     [
    //         'name' => 'Mike Johnson',
    //         'username' => '@mikej',
    //         'bio' => 'Photographer exploring the world one shot at a time 📷',
    //         'friends' => 183,
    //         'posts' => 234,
    //         'joined' => 'Feb 2024',
    //         'status' => 'friends'
    //     ],
    //     [
    //         'name' => 'Sarah Williams',
    //         'username' => '@sarahw',
    //         'bio' => 'Marketing expert | Travel enthusiast | Dog mom 🐕',
    //         'friends' => 398,
    //         'posts' => 67,
    //         'joined' => 'Jan 2025',
    //         'status' => 'stranger'
    //     ],
    //     [
    //         'name' => 'David Brown',
    //         'username' => '@davidb',
    //         'bio' => 'Fitness coach helping people achieve their goals 💪',
    //         'friends' => 672,
    //         'posts' => 423,
    //         'joined' => 'Dec 2023',
    //         'status' => 'stranger'
    //     ],
    //     [
    //         'name' => 'Emily Davis',
    //         'username' => '@emilyd',
    //         'bio' => 'Writer | Bookworm | Tea addict. Living one page at a time 📚',
    //         'friends' => 289,
    //         'posts' => 178,
    //         'joined' => 'Oct 2024',
    //         'status' => 'pending'
    //     ],
    //     [
    //         'name' => 'Alex Martinez',
    //         'username' => '@alexm',
    //         'bio' => 'Musician and music producer. Making beats and vibes 🎵',
    //         'friends' => 456,
    //         'posts' => 312,
    //         'joined' => 'Aug 2024',
    //         'status' => 'stranger'
    //     ],
    //     [
    //         'name' => 'Lisa Anderson',
    //         'username' => '@lisaa',
    //         'bio' => 'Chef & food blogger. Sharing recipes and culinary adventures 🍳',
    //         'friends' => 534,
    //         'posts' => 289,
    //         'joined' => 'May 2024',
    //         'status' => 'friends'
    //     ],
    //     [
    //         'name' => 'Chris Taylor',
    //         'username' => '@christ',
    //         'bio' => 'Gaming streamer | Tech enthusiast | Always online 🎮',
    //         'friends' => 892,
    //         'posts' => 567,
    //         'joined' => 'Nov 2023',
    //         'status' => 'stranger'
    //     ],
    // ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Find Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search Bar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex gap-4">
                        <input type="text" name="username" placeholder="Search users by name or email..."
                            class="flex-1 px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition">
                        <button id="searchBtn"
                            class="bg-gradient-to-r from-green-400 to-blue-500 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition">
                            Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Users Grid -->
            <div id="users_grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            </div>
            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <div class="bg-white px-6 py-3 rounded-lg shadow-sm">
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition">
                            Previous
                        </button>
                        <button
                            class="px-4 py-2 bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-lg font-medium">
                            1
                        </button>
                        <button class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition">
                            2
                        </button>
                        <button class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition">
                            3
                        </button>
                        <button class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition">
                            Next
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/dashboard.js'])
    @endpush
</x-app-layout>
