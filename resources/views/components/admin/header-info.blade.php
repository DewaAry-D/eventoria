@props([
    'title',
    'description' => null,
    'downloadUrl' => null // Muncul jika diisi link/route
])

<div class="flex flex-col gap-md sm:flex-row sm:items-center sm:justify-between w-full mb-lg">
    
    <div class="space-y-1">
        <h3 class="text-headline-lg font-bold text-primary tracking-tight leading-none">
            {{ $title }}
        </h3>
        @if($description)
            <p class="text-body-md text-on-surface-variant/80 font-medium leading-relaxed">
                {{ $description }}
            </p>
        @endif
    </div>

    @if($downloadUrl)
        <div class="shrink-0">
            <a href="{{ $downloadUrl }}" 
                class="inline-flex items-center justify-center gap-xs px-lg py-md bg-primary text-on-primary font-bold rounded-lg shadow-sm hover:bg-primary/90 transition-colors w-full sm:w-auto text-body-md">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                </svg>
                <span>Unduh Laporan</span>
            </a>
        </div>
    @endif

</div>