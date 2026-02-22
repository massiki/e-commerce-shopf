@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-xl transition-all duration-200 active:scale-95';
    $variants = [
        'primary' => 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-300 hover:-translate-y-0.5',
        'secondary' => 'bg-gray-100 text-gray-700 hover:bg-gray-200',
        'danger' => 'bg-red-500 text-white shadow-lg shadow-red-200 hover:bg-red-600',
        'outline' => 'border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50',
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs gap-1',
        'md' => 'px-5 py-2.5 text-sm gap-2',
        'lg' => 'px-6 py-3 text-base gap-2',
    ];
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
