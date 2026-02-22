<footer class="border-t border-gray-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Brand --}}
            <div class="sm:col-span-2 lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopF</span>
                </a>
                <p class="mt-3 text-sm text-gray-500">Your premium online marketplace for quality products. Discover, shop, and enjoy.</p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-900">Quick Links</h4>
                <ul class="mt-3 space-y-2">
                    <li><a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Home</a></li>
                    <li><a href="{{ route('shop.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Shop</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Cart</a></li>
                </ul>
            </div>

            {{-- Categories --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-900">Categories</h4>
                <ul class="mt-3 space-y-2">
                    @php $categories = \App\Models\Product::select('category')->distinct()->pluck('category'); @endphp
                    @foreach($categories->take(5) as $category)
                        <li><a href="{{ route('shop.index', ['category' => $category]) }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">{{ $category }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Account --}}
            <div>
                <h4 class="text-sm font-semibold text-gray-900">Account</h4>
                <ul class="mt-3 space-y-2">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t border-gray-100 pt-6 text-center">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} ShopF. All rights reserved.</p>
        </div>
    </div>
</footer>
