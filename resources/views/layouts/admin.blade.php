<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'ShopF') }} Admin - @yield('title', 'Dashboard')</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 font-sans text-gray-800 antialiased">
  {{-- Admin Navbar --}}
  <nav class="sticky top-0 z-50 border-b border-gray-200 bg-white/80 backdrop-blur-xl" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center gap-6">
          <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            <div
              class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-200">
              <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <span
              class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopF</span>
            <span
              class="hidden sm:inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700">Admin</span>
          </a>
          <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('admin.dashboard') }}"
              class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
              Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}"
              class="rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
              Products
            </a>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <a href="{{ route('home') }}"
            class="rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
            View Store
          </a>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
              class="rounded-xl bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-all hover:bg-red-50 hover:text-red-600">
              Logout
            </button>
          </form>
          {{-- Mobile Menu --}}
          <button @click="open = !open" class="md:hidden rounded-lg p-2 text-gray-600 hover:bg-gray-50">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
              <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      {{-- Mobile Menu --}}
      <div x-show="open" x-transition class="md:hidden border-t border-gray-100 pb-4 pt-2">
        <a href="{{ route('admin.dashboard') }}"
          class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">Dashboard</a>
        <a href="{{ route('admin.products.index') }}"
          class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.products.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">Products</a>
      </div>
    </div>
  </nav>

  <x-toast />

  <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    @yield('content')
  </main>

  @stack('scripts')
</body>

</html>
