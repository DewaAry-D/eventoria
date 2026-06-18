@props([
    'title',
    'value',
    'badge' => null,
    'badgeType' => 'success', // 'success', 'error', 'neutral'
    'iconType' => 'primary'   // 'primary', 'secondary', 'error', 'info'
])

<div class="bg-surface-container-lowest p-sm sm:p-md rounded-xl shadow-card border border-outline-variant/30 flex flex-row sm:flex-col items-center sm:items-start justify-between sm:justify-start w-full gap-sm sm:gap-0 transition-all">
    
    <div class="flex sm:flex-row items-center justify-between sm:w-full shrink-0">
        <div class="p-2 sm:p-sm rounded-md
            {{ $iconType === 'primary' ? 'bg-primary/5 text-primary' : '' }}
            {{ $iconType === 'secondary' ? 'bg-secondary-container/50 text-on-secondary-container' : '' }}
            {{ $iconType === 'error' ? 'bg-error/5 text-error' : '' }}
            {{ $iconType === 'info' ? 'bg-primary-fixed text-on-primary-fixed-variant' : '' }}
        ">
            {{ $icon }}
        </div>

        @if($badge)
            <span class="hidden sm:inline-flex text-label-md px-sm py-1 rounded-full font-bold items-center gap-xs
                {{ $badgeType === 'success' ? 'bg-success/10 text-success' : '' }}
                {{ $badgeType === 'error' ? 'bg-error-container text-on-error-container' : '' }}
                {{ $badgeType === 'neutral' ? 'bg-surface-container-high text-on-surface-variant' : '' }}
            ">
                @if($badgeType === 'success')
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                @endif
                {{ $badge }}
            </span>
        @endif
    </div>

    <div class="flex-1 min-w-0 sm:mt-xl px-xs sm:px-0">
        <p class="text-2xl sm:text-headline-lg sm:font-bold font-bold text-on-surface tracking-tight leading-none">{{ $value }}</p>
        <p class="text-body-md text-on-surface-variant font-medium mt-1 sm:mt-sm truncate sm:whitespace-normal leading-tight">{{ $title }}</p>
    </div>

    @if($badge)
        <div class="sm:hidden shrink-0">
            <span class="text-label-md px-sm py-1 rounded-full font-bold inline-flex items-center gap-xs
                {{ $badgeType === 'success' ? 'bg-success/10 text-success' : '' }}
                {{ $badgeType === 'error' ? 'bg-error-container text-on-error-container' : '' }}
                {{ $badgeType === 'neutral' ? 'bg-surface-container-high text-on-surface-variant' : '' }}
            ">
                {{ $badge }}
            </span>
        </div>
    @endif

</div>