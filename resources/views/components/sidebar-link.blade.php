@props(['active' => false, 'icon', 'label', 'href' => '#'])

<a href="{{ $href }}"
    class="flex items-center gap-3 px-3 py-3 rounded-xl font-medium transition-all duration-300 group relative mb-1
   {{ $active
       ? 'bg-[#10B981]/15 text-[#10B981] shadow-[0_0_15px_-3px_rgba(16,185,129,0.2)]'
       : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">

    <div
        class="shrink-0 w-6 h-6 flex items-center justify-center transition-transform duration-300 group-hover:scale-110 {{ $active ? 'scale-110' : '' }}">
        {!! $icon !!}
    </div>

    <span class="whitespace-nowrap transition-all duration-300 origin-left" x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-200 delay-100" x-transition:enter-start="opacity-0 translate-x-2"
        x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        {{ $label }}
    </span>

    @if ($active)
        <div x-show="sidebarOpen"
            class="absolute right-2 w-1.5 h-1.5 rounded-full bg-brand-500 shadow-brand-500/50 shadow-sm">
        </div>
    @endif

    <div x-show="!sidebarOpen"
        class="absolute left-14 bg-dark-surface border border-dark-border text-white text-xs px-3 py-1.5 rounded-md shadow-xl opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 z-50 pointer-events-none whitespace-nowrap">
        {{ $label }}
    </div>
</a>
