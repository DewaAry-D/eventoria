<header class="w-full bg-surface-container-lowest border-b border-outline-variant/30 px-md py-sm sm:py-md flex items-center justify-between gap-md sticky top-0 z-30">
    
    <!-- SISI KIRI: Pill Tanggal                     -->
    <div class="shrink-0">
        <div class="inline-flex items-center gap-xs px-md py-2 bg-surface-container border border-outline-variant/30 rounded-full text-secondary font-medium text-body-md shadow-sm">
            <svg class="w-4 h-4 text-secondary/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</span>
        </div>
    </div>

    <!-- SISI KANAN: Notifikasi, Kalender, & Profil  -->
    <div class="flex items-center gap-sm sm:gap-md">
        
        <!-- Tombol Notifikasi -->
        <button class="p-sm text-secondary hover:bg-surface-container hover:text-on-surface rounded-full transition-colors relative focus:outline-none shrink-0">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full ring-2 ring-surface-container-lowest"></span>
        </button>

        <!-- Tombol Kalender -->
        <button class="p-sm text-secondary hover:bg-surface-container hover:text-on-surface rounded-full transition-colors focus:outline-none shrink-0">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </button>

        <!-- Garis Pembatas -->
        <div class="h-6 w-[1px] bg-outline-variant/60 mx-xs sm:mx-sm shrink-0"></div>

        <!-- LINK PROFIL USER -->
        <a href="#" class="flex items-center gap-xs sm:gap-sm hover:opacity-85 transition-opacity group">
            
            <!-- Nama & Jabatan (hidden di HP, sm:block muncul mulai dari layar tablet mini ke atas) -->
            <div class="text-right hidden sm:block">
                <p class="text-body-md font-bold text-on-surface leading-tight group-hover:text-primary transition-colors">
                    {{ Auth::user()->adminKampus?->nama_admin ?? (Auth::user()->name ?? 'Dr. Aris Setiawan') }}
                </p>
                <p class="text-caption text-on-surface-variant font-medium mt-0.5">
                    Super Admin
                </p>
            </div>
            
            <!-- Foto Profil -->
            <img class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover ring-2 ring-surface-container group-hover:ring-primary/30 transition-all shrink-0" 
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->adminKampus?->nama_admin ?? (Auth::user()->name ?? 'Dr Aris Setiawan')) }}&background=000666&color=fff" 
                    alt="Profile">
        </a>

    </div>
</header>