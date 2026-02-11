<x-app-layout>

    <div class="min-h-screen flex items-center justify-center">

        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full mx-4 text-center">

            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">

                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 

                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                </svg>

            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">Link Expired</h1>

            <p class="text-gray-600 mb-6">{{ $message }}</p>

            <a href="{{ route('feed.view') }}" 

               class="inline-block bg-gradient-to-r from-green-400 to-blue-500 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transition">

                Go to Feed

            </a>

        </div>

    </div>

</x-app-layout>