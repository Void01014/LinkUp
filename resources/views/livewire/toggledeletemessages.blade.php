<?php

use function Livewire\Volt\{state};


state(['active']); 

$toggle = function () {
    $user = Auth::user();
    $user->auto_delete = !$user->auto_delete;
    $user->save();
    $this->active = !$this->active;
};

?>

<div class="form-group">
    <label class="flex items-center justify-between cursor-pointer p-4 rounded-xl hover:bg-gray-50 transition-colors">
        <div>
            <span class="text-[16px] font-semibold text-[#1e293b]">Auto-delete messages</span>
            <p class="helper-text">Clean up history automatically</p>
        </div>

        <div class="relative inline-block w-12 h-6 transition duration-200 ease-in-out">
            <input type="checkbox" 
                   wire:click="toggle"
                   {{ $active ? 'checked' : '' }}
                   class="opacity-0 w-0 h-0 peer">
            
            <div class="absolute inset-0 rounded-full bg-gray-300 peer-checked:bg-gradient-to-r peer-checked:from-green-400 peer-checked:to-blue-500 transition-all duration-300"></div>
            
            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 peer-checked:translate-x-6"></div>
        </div>
    </label>
</div>