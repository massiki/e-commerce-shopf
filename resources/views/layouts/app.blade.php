<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="ShopF - Your premium online marketplace for quality products">
    <title>{{ config('app.name', 'ShopF') }} - @yield('title', 'Premium Marketplace')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 font-sans text-gray-800 antialiased">
    <x-navbar />
    <x-toast />

    <main class="min-h-[calc(100vh-160px)]">
        @yield('content')
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>
