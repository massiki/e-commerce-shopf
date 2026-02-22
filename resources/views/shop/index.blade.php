@extends('layouts.app')
@section('title', 'Shop')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Shop</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $products->total() }} products found</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="mt-6 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
        <form action="{{ route('shop.index') }}" method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                       class="w-full rounded-xl border border-gray-200 bg-gray-50/50 py-2.5 pl-10 pr-4 text-sm text-gray-800 placeholder-gray-400 transition-all focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
            </div>

            {{-- Category Filter --}}
            <select name="category" class="rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-700 transition-all focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>

            {{-- Sort --}}
            <select name="sort" class="rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-700 transition-all focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
            </select>

            <div class="flex gap-2">
                <button type="submit" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-200 transition-all hover:bg-indigo-700 hover:shadow-lg">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('shop.index') }}" class="rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-200">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Products Grid --}}
    @if($products->isEmpty())
        <div class="mt-16 text-center">
            <svg class="mx-auto h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <h3 class="mt-4 text-lg font-medium text-gray-500">No products found</h3>
            <p class="mt-1 text-sm text-gray-400">Try adjusting your search or filter criteria.</p>
            <a href="{{ route('shop.index') }}" class="mt-6 inline-flex rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition-all hover:bg-indigo-700">
                Clear Filters
            </a>
        </div>
    @else
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
