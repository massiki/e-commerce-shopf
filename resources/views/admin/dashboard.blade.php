@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500">Overview of your store performance</p>

    {{-- Stats Cards --}}
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50">
                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                    <p class="text-xs text-gray-500">Products</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
                    <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] }}</p>
                    <p class="text-xs text-gray-500">Orders</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50">
                    <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    <p class="text-xs text-gray-500">Customers</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50">
                    <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($stats['total_revenue'], 2) }}</p>
                    <p class="text-xs text-gray-500">Revenue</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="mt-8">
        <h2 class="text-lg font-bold text-gray-900">Recent Orders</h2>
        @if($recentOrders->isEmpty())
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-400">No orders yet</p>
            </div>
        @else
            <div class="mt-4 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-gray-50 bg-gray-50/50">
                                <th class="px-5 py-3 font-semibold text-gray-600">Order</th>
                                <th class="px-5 py-3 font-semibold text-gray-600">Customer</th>
                                <th class="px-5 py-3 font-semibold text-gray-600">Items</th>
                                <th class="px-5 py-3 font-semibold text-gray-600">Total</th>
                                <th class="px-5 py-3 font-semibold text-gray-600">Status</th>
                                <th class="px-5 py-3 font-semibold text-gray-600">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($recentOrders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-5 py-3.5 font-semibold text-gray-800">#{{ $order->id }}</td>
                                    <td class="px-5 py-3.5 text-gray-600">{{ $order->user->name }}</td>
                                    <td class="px-5 py-3.5 text-gray-600">{{ $order->items->count() }}</td>
                                    <td class="px-5 py-3.5 font-semibold text-indigo-600">${{ number_format($order->total, 2) }}</td>
                                    <td class="px-5 py-3.5">
                                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium
                                            {{ $order->status === 'pending' ? 'bg-amber-50 text-amber-700' : '' }}
                                            {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                            {{ $order->status === 'cancelled' ? 'bg-red-50 text-red-700' : '' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
