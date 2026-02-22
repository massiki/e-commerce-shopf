@props(['id', 'title' => ''])

<div x-data="{ open: false }" x-on:open-modal-{{ $id }}.window="open = true">
    {{-- Trigger --}}
    <div @click="open = true">
        {{ $trigger ?? '' }}
    </div>

    {{-- Modal --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[70] flex items-center justify-center p-4" style="display:none">
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="open = false"></div>
        <div x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0"
             class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">
            @if($title)
                <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
            @endif
            <div class="mt-3">{{ $slot }}</div>
            <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
</div>
