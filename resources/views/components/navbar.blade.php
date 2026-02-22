@php
    $cartCount = 0;
    if (auth()->check()) {
        $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
        $cartCount = $cart ? $cart->items->sum('quantity') : 0;
    } elseif (session('cart_id')) {
        $cart = \App\Models\Cart::find(session('cart_id'));
        $cartCount = $cart ? $cart->items->sum('quantity') : 0;
    }
@endphp

<nav class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-xl" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-200 transition-transform group-hover:scale-110">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopF</span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('shop.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Shop</a>
            </div>

            {{-- Right side --}}
            <div class="flex items-center gap-3">
                {{-- Cart --}}
                <a href="{{ route('cart.index') }}" class="relative rounded-xl p-2 text-gray-600 transition-colors hover:bg-gray-50 hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    @if($cartCount > 0)
                        <span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600 text-[10px] font-bold text-white">{{ $cartCount > 9 ? '9+' : $cartCount }}</span>
                    @endif
                </a>

                {{-- Auth Links --}}
                @auth
                    <div class="relative" x-data="{ userOpen: false }">
                        <button @click="userOpen = !userOpen" class="flex items-center gap-2 rounded-xl bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-indigo-50 hover:text-indigo-700">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 text-xs font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                            <svg class="h-4 w-4 transition-transform" :class="userOpen && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="userOpen" @click.away="userOpen = false" x-transition class="absolute right-0 mt-2 w-48 rounded-xl border border-gray-100 bg-white p-1 shadow-xl">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                                Dashboard
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Admin Panel
                                </a>
                            @endif
                            <hr class="my-1 border-gray-100">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex rounded-xl px-4 py-2 text-sm font-medium text-gray-600 transition-colors hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:shadow-indigo-300 hover:-translate-y-0.5">Register</a>
                @endauth

                {{-- Mobile Menu --}}
                <button @click="open = !open" class="md:hidden rounded-lg p-2 text-gray-600 hover:bg-gray-50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-transition class="md:hidden border-t border-gray-100 pb-4 pt-2">
            <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">Home</a>
            <a href="{{ route('shop.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('shop.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">Shop</a>
            @guest
                <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">Login</a>
            @endguest
        </div>
    </div>
</nav>
