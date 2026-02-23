@extends('layouts.admin')
@section('title', 'Products')

@section('content')
  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-900">Products</h1>
      <p class="mt-1 text-sm text-gray-500">Manage your product catalog</p>
    </div>
    <a href="{{ route('admin.products.create') }}"
      class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-200 transition-all hover:shadow-lg hover:-translate-y-0.5">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
      Add Product
    </a>
  </div>

  {{-- Search --}}
  <form action="{{ route('admin.products.index') }}" method="GET" class="mt-6">
    <div class="relative max-w-md">
      <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
        class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-10 pr-4 text-sm text-gray-800 shadow-sm transition-all focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
    </div>
  </form>

  {{-- Table --}}
  @if ($products->isEmpty())
    <div class="mt-12 text-center">
      <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
      </svg>
      <h3 class="mt-4 text-lg font-medium text-gray-500">No products found</h3>
      <a href="{{ route('admin.products.create') }}"
        class="mt-4 inline-flex rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white">Add Your First
        Product</a>
    </div>
  @else
    <div class="mt-4 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead>
            <tr class="border-b border-gray-50 bg-gray-50/50">
              <th class="px-5 py-3 font-semibold text-gray-600">Product</th>
              <th class="px-5 py-3 font-semibold text-gray-600">Category</th>
              <th class="px-5 py-3 font-semibold text-gray-600">Price</th>
              <th class="px-5 py-3 font-semibold text-gray-600">Stock</th>
              <th class="px-5 py-3 font-semibold text-gray-600 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
            @foreach ($products as $product)
              <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-3">
                    <div class="h-10 w-10 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                      @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                          class="h-full w-full object-cover">
                      @else
                        <div class="flex h-full w-full items-center justify-center">
                          <svg class="h-5 w-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                          </svg>
                        </div>
                      @endif
                    </div>
                    <span class="font-medium text-gray-800">{{ $product->name }}</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span
                    class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">{{ $product->category }}</span>
                </td>
                <td class="px-5 py-3.5 font-semibold text-indigo-600"><span class="text-xs">Rp</span>
                  {{ number_format($product->price, 0, ',', '.') }}
                </td>
                <td class="px-5 py-3.5">
                  <span
                    class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $product->stock > 10 ? 'bg-emerald-50 text-emerald-700' : ($product->stock > 0 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }}">
                    {{ $product->stock }}
                  </span>
                </td>
                <td class="px-5 py-3.5 text-right">
                  <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}"
                      class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-indigo-50 hover:text-indigo-600">
                      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="rounded-lg p-2 text-gray-500 transition-colors hover:bg-red-50 hover:text-red-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-6">
      {{ $products->links() }}
    </div>
  @endif
@endsection
