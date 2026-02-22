@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('shop.index') }}" class="hover:text-indigo-600 transition-colors">Shop</a>
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700 font-medium">{{ $product->name }}</span>
    </nav>

    {{-- Product Detail --}}
    <div class="mt-8 grid grid-cols-1 gap-10 lg:grid-cols-2">
        {{-- Image --}}
        <div class="aspect-square overflow-hidden rounded-3xl border border-gray-100 bg-gradient-to-br from-gray-50 to-gray-100 shadow-sm">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
            @else
                <div class="flex h-full w-full items-center justify-center">
                    <svg class="h-32 w-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="flex flex-col justify-center">
            <span class="inline-flex w-fit items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                {{ $product->category }}
            </span>
            <h1 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl">{{ $product->name }}</h1>

            <div class="mt-4 flex items-center gap-3">
                <span class="text-3xl font-extrabold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                @if($product->stock > 0)
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        In Stock ({{ $product->stock }})
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                        Out of Stock
                    </span>
                @endif
            </div>

            <p class="mt-6 text-gray-600 leading-relaxed">{{ $product->description }}</p>

            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                    @csrf
                    <div class="flex items-center gap-4">
                        <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50">
                            <button type="button" onclick="decrementQty()" class="px-4 py-3 text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 border-0 bg-transparent text-center text-sm font-semibold text-gray-800 focus:outline-none focus:ring-0">
                            <button type="button" onclick="incrementQty()" class="px-4 py-3 text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </button>
                        </div>
                        <button type="submit" class="flex-1 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:shadow-indigo-300 hover:-translate-y-0.5 active:scale-95">
                            Add to Cart
                        </button>
                    </div>
                </form>
            @else
                <div class="mt-8">
                    <button disabled class="w-full rounded-2xl bg-gray-200 px-8 py-3.5 text-sm font-bold text-gray-400 cursor-not-allowed">
                        Out of Stock
                    </button>
                </div>
            @endif

            {{-- Features --}}
            <div class="mt-8 grid grid-cols-3 gap-4 border-t border-gray-100 pt-8">
                <div class="text-center">
                    <svg class="mx-auto h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"/></svg>
                    <p class="mt-2 text-xs font-medium text-gray-600">Free Shipping</p>
                </div>
                <div class="text-center">
                    <svg class="mx-auto h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <p class="mt-2 text-xs font-medium text-gray-600">Secure Payment</p>
                </div>
                <div class="text-center">
                    <svg class="mx-auto h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <p class="mt-2 text-xs font-medium text-gray-600">Easy Returns</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->isNotEmpty())
        <section class="mt-16 border-t border-gray-100 pt-12">
            <h2 class="text-2xl font-bold text-gray-900">Related Products</h2>
            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </section>
    @endif
</div>

@push('scripts')
<script>
    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
    }
    function decrementQty() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    }
</script>
@endpush
@endsection
