@extends('layouts.app')
@section('title', 'Home')

@section('content')
{{-- Hero Section --}}
<section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800">
    <div class="absolute inset-0">
        <div class="absolute -top-40 -right-40 h-96 w-96 rounded-full bg-purple-500/30 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-indigo-400/20 blur-3xl"></div>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
        <div class="text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium text-indigo-100 backdrop-blur-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                New Arrivals Available
            </span>
            <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Discover Premium
                <span class="block bg-gradient-to-r from-indigo-200 to-purple-200 bg-clip-text text-transparent">Products</span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-indigo-100/80">
                Explore our curated collection of high-quality products. From electronics to lifestyle essentials, find everything you need in one place.
            </p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('shop.index') }}" class="group inline-flex items-center gap-2 rounded-2xl bg-white px-8 py-4 text-sm font-bold text-indigo-700 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-0.5">
                    Shop Now
                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 rounded-2xl border-2 border-white/20 px-8 py-4 text-sm font-bold text-white transition-all hover:bg-white/10">
                    Browse Categories
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Categories --}}
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Shop by Category</h2>
        <p class="mt-2 text-gray-500">Find exactly what you're looking for</p>
    </div>
    <div class="mt-8 flex flex-wrap justify-center gap-3">
        @foreach($categories as $category)
            <a href="{{ route('shop.index', ['category' => $category]) }}"
               class="group rounded-2xl border border-gray-100 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-sm transition-all hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-md hover:-translate-y-0.5">
                {{ $category }}
            </a>
        @endforeach
    </div>
</section>

{{-- Featured Products --}}
<section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Featured Products</h2>
            <p class="mt-2 text-gray-500">Our latest and most popular items</p>
        </div>
        <a href="{{ route('shop.index') }}" class="hidden sm:inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
            View All
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
    </div>

    @if($featuredProducts->isEmpty())
        <div class="mt-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            <h3 class="mt-4 text-lg font-medium text-gray-500">No products yet</h3>
            <p class="mt-1 text-sm text-gray-400">Products will appear here once added.</p>
        </div>
    @else
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($featuredProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @endif
</section>

{{-- Stats / Trust Badges --}}
<section class="border-t border-gray-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-6 lg:grid-cols-4">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                </div>
                <h3 class="mt-3 text-2xl font-bold text-gray-900">500+</h3>
                <p class="mt-1 text-sm text-gray-500">Products</p>
            </div>
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50">
                    <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="mt-3 text-2xl font-bold text-gray-900">Best Price</h3>
                <p class="mt-1 text-sm text-gray-500">Guarantee</p>
            </div>
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0L16 3m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <h3 class="mt-3 text-2xl font-bold text-gray-900">Free</h3>
                <p class="mt-1 text-sm text-gray-500">Returns</p>
            </div>
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50">
                    <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="mt-3 text-2xl font-bold text-gray-900">Secure</h3>
                <p class="mt-1 text-sm text-gray-500">Payment</p>
            </div>
        </div>
    </div>
</section>
@endsection
