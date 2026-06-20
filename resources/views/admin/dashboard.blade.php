<x-admin-layout>
    <div class="p-md lg:p-lg space-y-lg">
        
        <x-admin.header-info 
            title="Dashboard Overview" 
            description="Selamat datang kembali, mari kelola aktivitas kampus hari ini.">
            
            <x-slot name="action">
                <a href="#" class="inline-flex items-center justify-center gap-xs px-lg py-md bg-primary text-on-primary font-bold rounded-lg shadow-sm hover:bg-primary/90 transition-colors w-full sm:w-auto text-body-md">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                    </svg>
                    <span>Unduh Laporan</span>
                </a>
            </x-slot>
        </x-admin.header-info>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-sm sm:gap-md w-full">

            <x-admin.card.stat-card-bento value="248" title="Organisasi Aktif" badgeText="+12%" badgeType="success" iconBg="neutral">
                <x-slot name="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </x-slot>
                <x-slot name="badgeIcon">
                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.816667 7L0 6.18333L4.31667 1.8375L6.65 4.17083L9.68333 1.16667H8.16667V0H11.6667V3.5H10.5V1.98333L6.65 5.83333L4.31667 3.5L0.816667 7Z" fill="currentColor"/></svg>
                </x-slot>
            </x-admin.card.stat-card-bento>
        
            <x-admin.card.stat-card-bento value="542" title="Event Berlangsung" badgeText="+12%" badgeType="success" iconBg="neutral">
                <x-slot name="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </x-slot>
                <x-slot name="badgeIcon">
                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/xl"><path d="M0.816667 7L0 6.18333L4.31667 1.8375L6.65 4.17083L9.68333 1.16667H8.16667V0H11.6667V3.5H10.5V1.98333L6.65 5.83333L4.31667 3.5L0.816667 7Z" fill="currentColor"/></svg>
                </x-slot>
            </x-admin.card.stat-card-bento>
        
            <x-admin.card.stat-card-bento value="5" title="Pengajuan Organisasi" badgeText="Pending" badgeType="neutral" iconBg="neutral">
                <x-slot name="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </x-slot>
            </x-admin.card.stat-card-bento>
        
            <x-admin.card.stat-card-bento value="12" title="Pengajuan Event" badgeText="High Priority" badgeType="error" iconBg="error">
                <x-slot name="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </x-slot>
            </x-admin.card.stat-card-bento>
        
        </div>

        <div class="bg-surface-container-lowest overflow-hidden shadow-sm rounded-xl border border-outline-variant/30 p-md">
            <p class="text-body-md font-medium text-on-surface">
                Selamat datang kembali, <span class="font-bold text-primary">{{ Auth::user()->adminKampus?->nama_admin ?? (Auth::user()->name ?? 'Admin') }}</span>! Anda berhasil masuk ke panel kendali utama Super Admin.
            </p>
        </div>

        </div>
</x-admin-layout>