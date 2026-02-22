@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<div class="w-full max-w-md">
    <div class="text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-200">
                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopF</span>
        </a>
        <h2 class="mt-6 text-2xl font-bold text-gray-900">Welcome back</h2>
        <p class="mt-2 text-sm text-gray-500">Sign in to your account</p>
    </div>

    <div class="mt-8 rounded-2xl border border-gray-100 bg-white p-8 shadow-xl shadow-gray-100/50">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <x-form-input name="email" type="email" label="Email" placeholder="you@example.com" required />
            <x-form-input name="password" type="password" label="Password" placeholder="••••••••" required />

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>

            <button type="submit" class="flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-xl hover:-translate-y-0.5">
                Sign In
            </button>
        </form>
    </div>

    <p class="mt-6 text-center text-sm text-gray-500">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Create one</a>
    </p>
</div>
@endsection
