@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Shopping Cart</h1>

    @if (!$cart || $cart->items->isEmpty())
      {{-- Empty State --}}
      <div class="mt-16 text-center">
        <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-gray-50">
          <svg class="h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
          </svg>
        </div>
        <h3 class="mt-6 text-lg font-medium text-gray-500">Your cart is empty</h3>
        <p class="mt-2 text-sm text-gray-400">Add some products to get started!</p>
        <a href="{{ route('shop.index') }}"
          class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:-translate-y-0.5">
          Continue Shopping
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </a>
      </div>
    @else
      <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-3">
        {{-- Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
          @foreach ($cart->items as $item)
            <div
              class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm transition-all hover:shadow-md sm:p-6">
              {{-- Product Image --}}
              <a href="{{ route('product.show', $item->product) }}"
                class="h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-gray-50 sm:h-28 sm:w-28">
                @if ($item->product->image)
                  <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                    class="h-full w-full object-cover">
                @else
                  <div class="flex h-full w-full items-center justify-center">
                    <svg class="h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                  </div>
                @endif
              </a>

              {{-- Info --}}
              <div class="flex flex-1 flex-col justify-between">
                <div class="flex items-start justify-between">
                  <div>
                    <a href="{{ route('product.show', $item->product) }}"
                      class="font-semibold text-gray-800 hover:text-indigo-600 transition-colors">{{ $item->product->name }}</a>
                    <p class="mt-0.5 text-xs text-gray-500">{{ $item->product->category }}</p>
                  </div>
                  <span class="text-lg font-bold text-indigo-600"><span class="text-xs">Rp</span>
                    {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="mt-3 flex items-center justify-between">
                  <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <div class="flex items-center rounded-xl border border-gray-200 bg-gray-50">
                      <button type="submit" name="quantity" value="{{ max(1, $item->quantity - 1) }}"
                        class="px-3 py-1.5 text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                      </button>
                      <span class="px-3 py-1.5 text-sm font-semibold text-gray-800">{{ $item->quantity }}</span>
                      <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                        class="px-3 py-1.5 text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                      </button>
                    </div>
                    <span class="text-xs text-gray-400"><span class="text-xs">Rp</span>
                      {{ number_format($item->product->price, 0, ',', '.') }} each</span>
                  </form>
                  <form action="{{ route('cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-500">
                      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        {{-- Order Summary --}}
        <div class="lg:col-span-1">
          <div class="sticky top-24 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-gray-900">Order Summary</h2>
            <div class="mt-4 space-y-3">
              <div class="flex justify-between text-sm text-gray-600">
                <span>Subtotal ({{ $cart->item_count }} items)</span>
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

            @auth
              <a href="{{ route('checkout.index') }}"
                class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:-translate-y-0.5">
                Proceed to Checkout
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
              </a>
            @else
              <a href="{{ route('login') }}"
                class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:-translate-y-0.5">
                Login to Checkout
              </a>
            @endauth

            <a href="{{ route('shop.index') }}"
              class="mt-3 flex w-full items-center justify-center rounded-xl bg-gray-50 px-6 py-3 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100">
              Continue Shopping
            </a>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection
