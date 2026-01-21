@props(['title', 'amount', 'trend', 'trendType' => 'up'])

@php
    $isNeutral = $trendType === '=';
    $isUp = $trendType === 'up';

    if ($isNeutral) {
        $trendColor = 'text-gray-400';
        $trendBg = 'bg-gray-500/10';
        $iconBg = 'bg-gray-500/20 text-gray-400';

        $trendIconSvg = '
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
            </svg>';
    } elseif ($isUp) {
        $trendColor = 'text-brand-500';
        $trendBg = 'bg-brand-500/10';
        $iconBg = 'bg-brand-500/20 text-brand-500';

        $trendIconSvg = '
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>';
    } else {
        $trendColor = 'text-red-500';
        $trendBg = 'bg-red-500/10';
        $iconBg = 'bg-red-500/20 text-red-500';

        $trendIconSvg = '
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
            </svg>';
    }
@endphp


<div
    class="bg-dark-surface p-6 rounded-2xl border border-dark-border shadow-lg 
            cursor-pointer select-none
            transition-all duration-300 ease-out
            hover:-translate-y-1 hover:shadow-xl hover:border-white/10 hover:bg-white/5
            active:scale-[0.98] active:bg-dark-surface/80 group">

    <div class="flex justify-between items-start mb-4">
        <div>
            <p class="text-dark-text text-sm font-medium group-hover:text-gray-300 transition-colors">{{ $title }}
            </p>
            <h3 class="text-2xl font-bold text-white mt-1 tracking-tight">{{ $amount }}</h3>
        </div>

        <div
            class="w-10 h-10 rounded-full {{ $iconBg }} flex items-center justify-center transition-transform duration-500{{ $isNeutral ? '' : 'group-hover:rotate-12' }}">
            @if ($isNeutral)
                <span class="text-xl font-bold leading-none">–</span>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform {{ $isUp ? '-rotate-45' : 'rotate-45' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            @endif

        </div>
    </div>

    <div
        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $trendColor }} {{ $trendBg }} border border-transparent group-hover:border-current transition-all">
        {!! $trendIconSvg !!}
        <span>{{ $trend }}</span>
        <span class="text-gray-400 font-normal ml-1 opacity-70">vs last month</span>
    </div>
</div>
