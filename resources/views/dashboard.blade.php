@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">My Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
        <a href="{{ route('shop.index') }}" class="rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-200 transition-all hover:shadow-lg hover:-translate-y-0.5">
            Continue Shopping
        </a>
    </div>

    {{-- Orders --}}
    <div class="mt-8">
        <h2 class="text-lg font-bold text-gray-900">Order History</h2>

        @if($orders->isEmpty())
            <div class="mt-8 text-center">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gray-50">
                    <svg class="h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h3 class="mt-4 text-lg font-medium text-gray-500">No orders yet</h3>
                <p class="mt-1 text-sm text-gray-400">Place your first order today!</p>
            </div>
        @else
            <div class="mt-4 space-y-4">
                @foreach($orders as $order)
                    <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <span class="text-sm font-bold text-gray-900">Order #{{ $order->id }}</span>
                                <span class="ml-2 inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $order->status === 'pending' ? 'bg-amber-50 text-amber-700' : '' }}
                                    {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-50 text-red-700' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <p class="mt-1 text-xs text-gray-500">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                            <span class="text-lg font-bold text-indigo-600">${{ number_format($order->total, 2) }}</span>
                        </div>

                        <div class="mt-3 border-t border-gray-50 pt-3">
                            <div class="flex flex-wrap gap-2">
                                @foreach($order->items as $item)
                                    <span class="inline-flex items-center gap-1 rounded-lg bg-gray-50 px-3 py-1.5 text-xs text-gray-600">
                                        {{ $item->product->name ?? 'Deleted Product' }} × {{ $item->quantity }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
