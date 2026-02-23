@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
  <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Checkout</h1>

    <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-5">
      {{-- Order Items --}}
      <div class="lg:col-span-3 space-y-4">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
          <h2 class="text-lg font-bold text-gray-900">Order Items</h2>
          <div class="mt-4 divide-y divide-gray-50">
            @foreach ($cart->items as $item)
              <div class="flex items-center gap-4 py-3">
                <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-gray-50">
                  @if ($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                      class="h-full w-full object-cover">
                  @else
                    <div class="flex h-full w-full items-center justify-center">
                      <svg class="h-6 w-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                      </svg>
                    </div>
                  @endif
                </div>
                <div class="flex-1">
                  <h4 class="text-sm font-semibold text-gray-800">{{ $item->product->name }}</h4>
                  <p class="text-xs text-gray-500">Qty: {{ $item->quantity }} ×
                    $<span class="text-xs">Rp</span>
                    {{ number_format($item->product->price, 0, ',', '.') }}</p>
                </div>
                <span class="text-sm font-bold text-gray-800"><span class="text-xs">Rp</span>
                  {{ number_format($item->subtotal, 0, ',', '.') }}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Summary & Place Order --}}
      <div class="lg:col-span-2">
        <div class="sticky top-24 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
          <h2 class="text-lg font-bold text-gray-900">Order Summary</h2>
          <div class="mt-4 space-y-3">
            <div class="flex justify-between text-sm text-gray-600">
              <span>Subtotal</span>
              <span class="font-medium"><span class="text-xs">Rp</span>
                {{ number_format($cart->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600">
              <span>Shipping</span>
              <span class="font-medium text-emerald-600">Free</span>
            </div>
            <hr class="border-gray-100">
            <div class="flex justify-between text-lg font-bold text-gray-900">
              <span>Total</span>
              <span class="text-indigo-600"><span class="text-xs">Rp</span>
                {{ number_format($cart->total, 0, ',', '.') }}</span>
            </div>
          </div>

          <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit"
              class="flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Place Order
            </button>
          </form>

          <a href="{{ route('cart.index') }}"
            class="mt-3 flex w-full items-center justify-center rounded-xl bg-gray-50 px-6 py-3 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100">
            Back to Cart
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
