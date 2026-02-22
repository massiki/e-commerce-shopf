@props(['product'])

<div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:shadow-xl hover:shadow-indigo-100/50 hover:-translate-y-1">
    {{-- Image --}}
    <a href="{{ route('product.show', $product) }}" class="block aspect-square overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
        @else
            <div class="flex h-full w-full items-center justify-center">
                <svg class="h-16 w-16 text-gray-300 transition-colors group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        @endif

        {{-- Category Badge --}}
        <span class="absolute top-3 left-3 rounded-full bg-white/90 backdrop-blur-sm px-3 py-1 text-xs font-medium text-gray-700 shadow-sm">
            {{ $product->category }}
        </span>

        {{-- Stock Warning --}}
        @if($product->stock <= 5 && $product->stock > 0)
            <span class="absolute top-3 right-3 rounded-full bg-amber-500 px-2.5 py-1 text-xs font-semibold text-white shadow-sm">
                Only {{ $product->stock }} left
            </span>
        @elseif($product->stock == 0)
            <span class="absolute top-3 right-3 rounded-full bg-red-500 px-2.5 py-1 text-xs font-semibold text-white shadow-sm">
                Out of stock
            </span>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-4">
        <a href="{{ route('product.show', $product) }}" class="block">
            <h3 class="text-sm font-semibold text-gray-800 line-clamp-1 group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h3>
            <p class="mt-1 text-xs text-gray-500 line-clamp-2">{{ $product->description }}</p>
        </a>

        <div class="mt-3 flex items-center justify-between">
            <span class="text-lg font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 rounded-xl bg-indigo-600 px-3 py-2 text-xs font-semibold text-white shadow-md shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-300 active:scale-95">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Add
                    </button>
                </form>
            @else
                <span class="rounded-xl bg-gray-100 px-3 py-2 text-xs font-medium text-gray-400">Sold out</span>
            @endif
        </div>
    </div>
</div>
