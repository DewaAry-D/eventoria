@props([
    'title',
    'value',
    'unit', // Teks kecil pendamping angka (contoh: 'Organisasi', 'Terdaftar')
    'footerLabel', // Teks di tombol/badge bawah (contoh: 'Perlu Verifikasi')
    'footerType' => 'primary', // 'primary', 'success', 'error'
    'iconType' => 'primary'
])

<div class="bg-surface-container-lowest p-sm sm:p-md rounded-xl shadow-card border border-outline-variant/30 flex flex-col w-full transition-all">
    
    <div class="flex justify-between items-center gap-sm w-full">
        <p class="text-body-md text-on-surface-variant font-semibold tracking-wide leading-tight truncate">{{ $title }}</p>
        
        <div class="p-2 sm:p-sm rounded-xl shrink-0
            {{ $iconType === 'primary' ? 'bg-primary/5 text-primary' : '' }}
            {{ $iconType === 'success' ? 'bg-success/10 text-success' : '' }}
            {{ $iconType === 'error' ? 'bg-error/5 text-error' : '' }}
        ">
            {{ $icon }}
        </div>
    </div>

    <div class="mt-sm sm:mt-md flex flex-row sm:flex-col items-center sm:items-start justify-between sm:justify-start gap-sm sm:gap-0">
        
        <div class="flex items-baseline gap-xs">
            <span class="text-2xl sm:text-display-lg font-bold text-on-surface tracking-tight leading-none">{{ $value }}</span>
            <span class="text-label-md text-on-surface-variant font-semibold pl-px">{{ $unit }}</span>
        </div>

        <div class="sm:mt-md">
            <span class="text-label-md px-sm sm:px-md py-1 rounded-full font-bold inline-block leading-normal
                {{ $footerType === 'primary' ? 'bg-primary text-on-primary' : '' }}
                {{ $footerType === 'success' ? 'bg-success/10 text-success' : '' }}
                {{ $footerType === 'error' ? 'bg-error-container text-on-error-container' : '' }}
            ">
                {{ $footerLabel }}
            </span>
        </div>

    </div>

</div>