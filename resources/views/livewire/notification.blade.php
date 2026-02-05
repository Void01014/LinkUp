<?php

use function Livewire\Volt\{state};


?>

<div id="notificationBtn" class="absolute flex flex-col items-end top-5 right-10">
    <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-full transition focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>

        {{-- <span class="absolute top-1.5 right-1.5 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
        </span> --}}
    </button>
    <div id="popup" class="bg-white shadow-[0_0_30px_gray] rounded-lg w-60 h-80 hidden">

    </div>
</div>
