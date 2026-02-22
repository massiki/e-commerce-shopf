@if(session('success') || session('error'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-2 opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="-translate-y-2 opacity-0"
     class="fixed top-20 right-4 z-[60] max-w-sm">
    @if(session('success'))
        <div class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-white px-5 py-4 shadow-xl shadow-emerald-100/50">
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="text-sm font-medium text-gray-800">{{ session('success') }}</p>
            <button @click="show = false" class="ml-2 text-gray-400 hover:text-gray-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 rounded-2xl border border-red-100 bg-white px-5 py-4 shadow-xl shadow-red-100/50">
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100">
                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
            <p class="text-sm font-medium text-gray-800">{{ session('error') }}</p>
            <button @click="show = false" class="ml-2 text-gray-400 hover:text-gray-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif
</div>
@endif
