@props(['title', 'amount', 'trend', 'trendType' => 'up', 'color' => 'brand'])

@php
    // Logic warna icon background dan text
    $iconBg = match ($trendType) {
        'up' => 'bg-emerald-100 text-emerald-600',
        'down' => 'bg-red-100 text-red-600',
        default => 'bg-gray-100 text-gray-600',
    };

    $trendColor = match ($trendType) {
        'up' => 'text-emerald-600',
        'down' => 'text-red-600',
        default => 'text-gray-600',
    };

    $trendIcon = match ($trendType) {
        'up'
            => '<svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>',
        'down'
            => '<svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>',
        default => '',
    };
@endphp

<div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex justify-between items-start mb-4">
        <div>
            <p class="text-gray-500 text-sm font-medium">{{ $title }}</p>
            <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $amount }}</h3>
        </div>
        <div class="w-10 h-10 rounded-full {{ $iconBg }} flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform -rotate-45" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </div>
    </div>

    <div class="flex items-center {{ $trendColor }} text-xs font-semibold">
        {!! $trendIcon !!}
        <span>{{ $trend }}</span>
        <span class="text-gray-400 font-normal ml-1">from last month</span>
    </div>
</div>
