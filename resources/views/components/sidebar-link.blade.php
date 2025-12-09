@props(['active' => false, 'icon', 'label'])

@php
    $classes = $active
        ? 'flex items-center gap-3 px-3 py-2.5 rounded-lg bg-brand-50 text-brand-600 font-medium transition-all duration-200 group relative'
        : 'flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-500 hover:bg-gray-50 hover:text-gray-900 font-medium transition-all duration-200 group relative';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
        {!! $icon !!}
    </div>

    <span x-show="sidebarOpen" class="whitespace-nowrap transition-opacity duration-200" style="display: none;">
        {{ $label }}
    </span>

    <div x-show="!sidebarOpen"
        class="absolute left-14 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none whitespace-nowrap hidden md:block"
        style="display: none;">
        {{ $label }}
    </div>
</a>
